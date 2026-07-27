<form
    class="contact-form"
    method="post"
    action="{{ route('contact.store') }}"
    data-contact-form
    novalidate
>
    @csrf

    <div class="contact-form__field mb-3">
        <input
            id="contact-name"
            class="form-control"
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Name"
            aria-label="Name"
            required
            autocomplete="name"
        >
        <div class="invalid-feedback" data-error-for="name"></div>
    </div>

    <div class="contact-form__field mb-3">
        <input
            id="contact-email"
            class="form-control"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Email Address"
            aria-label="Email Address"
            required
            autocomplete="email"
        >
        <div class="invalid-feedback" data-error-for="email"></div>
    </div>

    <div class="contact-form__field mb-4">
        <textarea
            id="contact-message"
            class="form-control"
            name="message"
            rows="5"
            placeholder="Message"
            aria-label="Message"
            required
        >{{ old('message') }}</textarea>
        <div class="invalid-feedback" data-error-for="message"></div>
    </div>

    <div class="contact-form__actions">
        <button class="btn-pill btn-pill--dark btn-pill--wide" type="submit" data-contact-submit>
            Submit
        </button>
    </div>

    <p class="contact-form__status mt-3 mb-0 text-center" data-contact-status role="status" hidden></p>
</form>
