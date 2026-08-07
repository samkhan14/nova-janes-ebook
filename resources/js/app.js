import 'bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;

import 'slick-carousel';

const navToggle = document.querySelector('[data-nav-toggle]');
const nav = document.querySelector('[data-site-nav]');

if (navToggle && nav) {
    navToggle.addEventListener('click', () => {
        const expanded = navToggle.getAttribute('aria-expanded') === 'true';
        navToggle.setAttribute('aria-expanded', String(!expanded));
        nav.classList.toggle('is-open', !expanded);
    });
}

const testimonialsSlider = document.querySelector('[data-testimonials-slider]');

if (testimonialsSlider && $.fn.slick) {
    $(testimonialsSlider).slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
        speed: 600,
        arrows: false,
        dots: false,
        infinite: true,
        pauseOnHover: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });
}

const testimonialsVideoWrap = document.querySelector('[data-testimonials-video]');

if (testimonialsVideoWrap) {
    const video = testimonialsVideoWrap.querySelector('video');
    const playBtn = testimonialsVideoWrap.querySelector('.testimonials__play');
    let sourceReady = false;

    const ensureVideoSource = () => {
        if (!video || sourceReady) {
            return Promise.resolve();
        }

        const src = video.dataset.src;

        if (!src) {
            return Promise.resolve();
        }

        return new Promise((resolve) => {
            const onReady = () => {
                video.removeEventListener('loadeddata', onReady);
                resolve();
            };

            video.addEventListener('loadeddata', onReady);

            const source = document.createElement('source');
            source.src = src;
            source.type = 'video/mp4';
            video.appendChild(source);
            video.load();
            sourceReady = true;
            video.removeAttribute('data-src');
        });
    };

    const setPlaying = (playing) => {
        testimonialsVideoWrap.classList.toggle('is-playing', playing);
        if (playBtn) {
            playBtn.setAttribute('aria-label', playing ? 'Pause video' : 'Play video');
        }
    };

    if ('IntersectionObserver' in window) {
        const videoObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    ensureVideoSource();
                    observer.disconnect();
                });
            },
            {
                rootMargin: '120px 0px',
                threshold: 0.15,
            }
        );

        videoObserver.observe(testimonialsVideoWrap);
    }

    playBtn?.addEventListener('click', async () => {
        if (!video) {
            return;
        }

        await ensureVideoSource();

        if (video.paused) {
            try {
                await video.play();
                setPlaying(true);
            } catch {
                setPlaying(false);
            }
            return;
        }

        video.pause();
        setPlaying(false);
    });

    video?.addEventListener('click', () => {
        if (!video.paused) {
            video.pause();
            setPlaying(false);
        }
    });

    video?.addEventListener('ended', () => {
        setPlaying(false);
    });

    video?.addEventListener('pause', () => {
        if (!video.ended) {
            setPlaying(false);
        }
    });
}

const contactForm = document.querySelector('[data-contact-form]');

if (contactForm) {
    const statusEl = contactForm.querySelector('[data-contact-status]');
    const submitBtn = contactForm.querySelector('[data-contact-submit]');
    const defaultSubmitLabel = submitBtn?.textContent?.trim() || 'Submit';

    const clearFieldErrors = () => {
        contactForm.querySelectorAll('.is-invalid').forEach((el) => {
            el.classList.remove('is-invalid');
        });

        contactForm.querySelectorAll('[data-error-for]').forEach((el) => {
            el.textContent = '';
        });
    };

    const showStatus = (message, type) => {
        if (!statusEl) {
            return;
        }

        statusEl.hidden = false;
        statusEl.textContent = message;
        statusEl.classList.remove('is-success', 'is-error');
        statusEl.classList.add(type === 'success' ? 'is-success' : 'is-error');
    };

    const setSubmitting = (isSubmitting) => {
        if (!submitBtn) {
            return;
        }

        submitBtn.disabled = isSubmitting;
        submitBtn.textContent = isSubmitting ? 'Sending...' : defaultSubmitLabel;
    };

    $(contactForm).on('submit', (event) => {
        event.preventDefault();
        clearFieldErrors();
        setSubmitting(true);

        if (statusEl) {
            statusEl.hidden = true;
            statusEl.textContent = '';
            statusEl.classList.remove('is-success', 'is-error');
        }

        $.ajax({
            url: contactForm.getAttribute('action'),
            method: 'POST',
            data: $(contactForm).serialize(),
            dataType: 'json',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .done((response) => {
                contactForm.reset();
                showStatus(response?.message || 'Thank you. Your message has been received.', 'success');
            })
            .fail((xhr) => {
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    const errors = xhr.responseJSON.errors;

                    Object.keys(errors).forEach((field) => {
                        const input = contactForm.querySelector(`[name="${field}"]`);
                        const errorEl = contactForm.querySelector(`[data-error-for="${field}"]`);
                        const message = Array.isArray(errors[field]) ? errors[field][0] : errors[field];

                        input?.classList.add('is-invalid');

                        if (errorEl) {
                            errorEl.textContent = message;
                        }
                    });

                    showStatus('Please fix the highlighted fields and try again.', 'error');
                    return;
                }

                const fallback =
                    xhr.responseJSON?.message ||
                    'Something went wrong. Please try again.';
                showStatus(fallback, 'error');
            })
            .always(() => {
                setSubmitting(false);
            });
    });
}

const revealEls = document.querySelectorAll('[data-reveal]');

if (revealEls.length) {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        revealEls.forEach((el) => el.classList.add('is-revealed'));
    } else {
        const revealObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                });
            },
            {
                // Low threshold so tall sections (e.g. gallery) still reveal on mobile
                threshold: 0.01,
                rootMargin: '0px 0px -2% 0px',
            }
        );

        revealEls.forEach((el) => revealObserver.observe(el));
    }
}

const galleryRoot = document.querySelector('[data-gallery]');
const galleryLightbox = document.querySelector('[data-gallery-lightbox]');
const galleryImage = document.querySelector('[data-gallery-image]');
const galleryClose = document.querySelector('[data-gallery-close]');

if (galleryRoot && galleryLightbox && galleryImage) {
    const openLightbox = (src, alt) => {
        galleryImage.src = src;
        galleryImage.alt = alt || '';
        galleryLightbox.hidden = false;
        document.body.classList.add('is-gallery-lightbox-open');
    };

    const closeLightbox = () => {
        galleryLightbox.hidden = true;
        galleryImage.removeAttribute('src');
        galleryImage.alt = '';
        document.body.classList.remove('is-gallery-lightbox-open');
    };

    galleryRoot.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-gallery-open]');

        if (!trigger || !galleryRoot.contains(trigger)) {
            return;
        }

        openLightbox(trigger.dataset.gallerySrc, trigger.dataset.galleryAlt);
    });

    galleryClose?.addEventListener('click', closeLightbox);

    galleryLightbox.addEventListener('click', (event) => {
        if (event.target === galleryLightbox) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !galleryLightbox.hidden) {
            closeLightbox();
        }
    });
}

const galleryAudio = document.querySelector('[data-gallery-audio]');

if (galleryAudio instanceof HTMLAudioElement) {
    const tryPlayGalleryAudio = () => {
        const playPromise = galleryAudio.play();

        if (playPromise && typeof playPromise.then === 'function') {
            playPromise.catch(() => {
                // Browsers often block autoplay with sound until the user interacts.
                const unlock = () => {
                    galleryAudio.play().catch(() => {});
                    window.removeEventListener('pointerdown', unlock);
                    window.removeEventListener('touchstart', unlock);
                    window.removeEventListener('keydown', unlock);
                };

                window.addEventListener('pointerdown', unlock, { once: true });
                window.addEventListener('touchstart', unlock, { once: true });
                window.addEventListener('keydown', unlock, { once: true });
            });
        }
    };

    if (document.readyState === 'complete') {
        tryPlayGalleryAudio();
    } else {
        window.addEventListener('load', tryPlayGalleryAudio, { once: true });
    }

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            galleryAudio.pause();
        } else {
            tryPlayGalleryAudio();
        }
    });
}

const bookDetail = document.querySelector('[data-book-detail]');

if (bookDetail instanceof HTMLElement) {
    const symbol = bookDetail.dataset.symbol || '$';
    const shipping = Number.parseFloat(bookDetail.dataset.shipping || '0') || 0;
    const qtyInput = bookDetail.querySelector('#quantity');
    const lineTotalEl = bookDetail.querySelector('[data-line-total]');
    const grandTotalEl = bookDetail.querySelector('[data-grand-total]');

    const selectedVariant = () =>
        bookDetail.querySelector('input[name="variant_id"]:checked');

    const formatMoney = (amount) => `${symbol}${amount.toFixed(2)}`;

    const refreshTotals = () => {
        const variant = selectedVariant();
        const qty = Math.max(1, Number.parseInt(String(qtyInput?.value || '1'), 10) || 1);
        const unit = Number.parseFloat(variant?.dataset.price || '0') || 0;
        const line = unit * qty;

        if (lineTotalEl) {
            lineTotalEl.textContent = formatMoney(line);
        }

        if (grandTotalEl) {
            grandTotalEl.textContent = formatMoney(line + shipping);
        }
    };

    bookDetail.addEventListener('change', refreshTotals);
    bookDetail.addEventListener('input', refreshTotals);
    refreshTotals();
}

/* =========================================================
   SHOP CART — AJAX (no full page refresh)
   ========================================================= */

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

const showShopToast = (message) => {
    let toast = document.querySelector('[data-shop-toast]');

    if (!toast) {
        toast = document.createElement('div');
        toast.className = 'shop-toast';
        toast.setAttribute('data-shop-toast', '');
        document.body.appendChild(toast);
    }

    toast.textContent = message;
    toast.classList.add('is-visible');

    window.clearTimeout(showShopToast._timer);
    showShopToast._timer = window.setTimeout(() => {
        toast.classList.remove('is-visible');
    }, 2800);
};

const updateCartBadges = (count) => {
    document.querySelectorAll('.shop-bar__badge').forEach((badge) => {
        badge.textContent = String(count);
    });
};

const postCartForm = (form) => {
    const methodInput = form.querySelector('input[name="_method"]');
    const method = (methodInput?.value || form.method || 'POST').toUpperCase();
    const body = new FormData(form);

    return fetch(form.action, {
        method: method === 'GET' ? 'GET' : 'POST',
        headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: method === 'GET' ? undefined : body,
        credentials: 'same-origin',
    }).then(async (response) => {
        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
            const message = data.message || Object.values(data.errors || {}).flat()[0] || 'Something went wrong.';
            throw new Error(message);
        }

        return data;
    });
};

const refreshCartPage = (cart) => {
    const page = document.querySelector('[data-cart-page]');

    if (!page || !cart) {
        return;
    }

    const emptyEl = page.querySelector('[data-cart-empty]');
    const filledEl = page.querySelector('[data-cart-filled]');

    if (cart.empty) {
        emptyEl?.removeAttribute('hidden');
        filledEl?.setAttribute('hidden', '');
        return;
    }

    emptyEl?.setAttribute('hidden', '');
    filledEl?.removeAttribute('hidden');

    const subtotal = page.querySelector('[data-cart-subtotal]');
    const shipping = page.querySelector('[data-cart-shipping]');
    const total = page.querySelector('[data-cart-total]');

    if (subtotal) subtotal.textContent = cart.subtotal_text;
    if (shipping) shipping.textContent = cart.shipping_text;
    if (total) total.textContent = cart.total_text;

    const byId = Object.fromEntries((cart.items || []).map((item) => [String(item.variant_id), item]));

    page.querySelectorAll('[data-cart-row]').forEach((row) => {
        const id = row.getAttribute('data-variant-id');
        const item = byId[id];

        if (!item) {
            row.remove();
            return;
        }

        const qtyInput = row.querySelector('input[name="quantity"]');
        const priceEl = row.querySelector('[data-line-price]');

        if (qtyInput) qtyInput.value = String(item.qty);
        if (priceEl) priceEl.textContent = item.line_total_text;
    });
};

document.querySelectorAll('[data-cart-add]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const submitBtn = form.querySelector('[data-cart-submit]');
        const statusEl = form.querySelector('[data-cart-status]');
        const defaultLabel = submitBtn?.textContent || 'Add to cart';

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Adding...';
        }

        postCartForm(form)
            .then((data) => {
                updateCartBadges(data.cart?.count ?? 0);
                showShopToast(data.message || 'Added to cart.');

                if (statusEl) {
                    statusEl.hidden = false;
                    statusEl.textContent = data.message || 'Added to cart.';
                }
            })
            .catch((error) => {
                showShopToast(error.message);
                if (statusEl) {
                    statusEl.hidden = false;
                    statusEl.textContent = error.message;
                }
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = defaultLabel;
                }
            });
    });
});

document.querySelectorAll('[data-cart-update], [data-cart-remove]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();

        postCartForm(form)
            .then((data) => {
                updateCartBadges(data.cart?.count ?? 0);
                refreshCartPage(data.cart);
                showShopToast(data.message || 'Cart updated.');

                const flash = document.querySelector('[data-cart-flash]');
                if (flash) {
                    flash.hidden = false;
                    flash.textContent = data.message || 'Cart updated.';
                }
            })
            .catch((error) => {
                showShopToast(error.message);
            });
    });
});
