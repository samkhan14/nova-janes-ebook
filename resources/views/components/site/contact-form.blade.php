<form class="contact-form" method="post" action="{{ route('contact.store') }}" novalidate>
    @csrf

    <div class="contact-form__field mb-3">
        <label for="contact-name">Username</label>
        <input
            id="contact-name"
            class="form-control @error('name') is-invalid @enderror"
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
            autocomplete="username"
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <div class="contact-form__field">
                <label for="contact-first-name">First Name</label>
                <input
                    id="contact-first-name"
                    class="form-control @error('first_name') is-invalid @enderror"
                    type="text"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    required
                    autocomplete="given-name"
                >
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="contact-form__field">
                <label for="contact-last-name">Last Name</label>
                <input
                    id="contact-last-name"
                    class="form-control @error('last_name') is-invalid @enderror"
                    type="text"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    required
                    autocomplete="family-name"
                >
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="contact-form__field mb-3">
        <label for="contact-email">Email Address</label>
        <input
            id="contact-email"
            class="form-control @error('email') is-invalid @enderror"
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            autocomplete="email"
        >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="contact-form__field mb-4">
        <label for="contact-message">Message</label>
        <textarea
            id="contact-message"
            class="form-control @error('message') is-invalid @enderror"
            name="message"
            rows="5"
            required
        >{{ old('message') }}</textarea>
        @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="contact-form__actions">
        <button class="btn-pill btn-pill--dark btn-pill--wide" type="submit">Submit</button>
    </div>

    @if (session('contact_status'))
        <p class="mt-3 mb-0 text-center" role="status">{{ session('contact_status') }}</p>
    @endif
</form>
