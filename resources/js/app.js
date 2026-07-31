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
                threshold: 0.18,
                rootMargin: '0px 0px -8% 0px',
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
