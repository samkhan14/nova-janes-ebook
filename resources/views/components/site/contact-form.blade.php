<form class="contact-form" method="post" action="{{ route('contact.store') }}" novalidate>
    @csrf

    <div class="mb-3">
        <label class="visually-hidden" for="contact-name">Full name</label>
        <input
            id="contact-name"
            class="form-control @error('name') is-invalid @enderror"
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Full Name"
            required
            autocomplete="name"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="visually-hidden" for="contact-email">Email</label>
            <input
                id="contact-email"
                class="form-control @error('email') is-invalid @enderror"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                required
                autocomplete="email"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="visually-hidden" for="contact-phone">Phone number</label>
            <input
                id="contact-phone"
                class="form-control @error('phone') is-invalid @enderror"
                type="tel"
                name="phone"
                value="{{ old('phone') }}"
                placeholder="Phone Number"
                autocomplete="tel"
            >
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label class="visually-hidden" for="contact-message">Message</label>
        <textarea
            id="contact-message"
            class="form-control @error('message') is-invalid @enderror"
            name="message"
            rows="5"
            placeholder="Message"
            required
        >{{ old('message') }}</textarea>
        @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn-pill btn-pill--dark" type="submit">Send Message</button>

    @if (session('contact_status'))
        <p class="mt-3 mb-0" role="status">{{ session('contact_status') }}</p>
    @endif
</form>
