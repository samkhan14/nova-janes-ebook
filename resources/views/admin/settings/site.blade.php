@extends('layouts.admin')

@section('heading', 'Site Settings')

@section('content')
<form method="POST" action="{{ route('admin.settings.site.update') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
    @csrf
    @method('PUT')

    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <div>
            <x-input-label for="site_name" value="Site Name" />
            <x-text-input id="site_name" name="site_name" class="mt-1 block w-full" :value="old('site_name', $values['site_name'])" required />
        </div>

        <div>
            <x-input-label for="meta_description" value="Meta Description" />
            <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('meta_description', $values['meta_description']) }}</textarea>
        </div>

        <div>
            <x-input-label for="contact_email" value="Contact Email" />
            <x-text-input id="contact_email" name="contact_email" type="email" class="mt-1 block w-full" :value="old('contact_email', $values['contact_email'])" />
        </div>

        <div>
            <x-input-label for="favicon" value="Favicon (optional)" />
            @if (!empty($values['favicon']))
                <img src="{{ \App\Support\CmsMedia::url($values['favicon']) }}" alt="" class="mt-2 mb-2 h-10 w-10 object-contain">
            @endif
            <input id="favicon" type="file" name="favicon" accept="image/*" class="mt-1 block w-full text-sm">
        </div>
    </section>

    <div class="flex justify-end">
        <x-primary-button>Save Settings</x-primary-button>
    </div>
</form>
@endsection
