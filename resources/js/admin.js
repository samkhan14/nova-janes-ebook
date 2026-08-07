import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/* Admin forms marked with data-ajax-form save without a full page reload */
document.querySelectorAll('[data-ajax-form]').forEach((form) => {
    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const statusEl = form.querySelector('[data-ajax-status]');
        const submitBtn = form.querySelector('button[type="submit"]');
        const defaultLabel = submitBtn ? submitBtn.textContent : '';

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving…';
        }

        if (statusEl) {
            statusEl.hidden = true;
            statusEl.textContent = '';
            statusEl.classList.remove('border-red-200', 'bg-red-50', 'text-red-800');
            statusEl.classList.add('border-green-200', 'bg-green-50', 'text-green-800');
        }

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: new FormData(form),
                credentials: 'same-origin',
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok || data.success === false) {
                const message = data.message
                    || Object.values(data.errors || {}).flat()[0]
                    || 'Save failed. Please try again.';
                throw new Error(message);
            }

            if (statusEl) {
                statusEl.hidden = false;
                statusEl.textContent = data.message || form.dataset.ajaxSuccess || 'Saved successfully.';
                statusEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        } catch (error) {
            if (statusEl) {
                statusEl.hidden = false;
                statusEl.classList.remove('border-green-200', 'bg-green-50', 'text-green-800');
                statusEl.classList.add('border-red-200', 'bg-red-50', 'text-red-800');
                statusEl.textContent = error.message || 'Save failed.';
                statusEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = defaultLabel;
            }
        }
    });
});
