@extends('layouts.admin')

@section('heading', 'CMS — Header')

@section('content')
<form method="POST" action="{{ route('admin.cms.header.update') }}" enctype="multipart/form-data" class="space-y-6 max-w-4xl"
      x-data="{ links: {{ Js::from(old('nav_links', $header['nav_links'] ?? [['label' => '', 'url' => '']])) }} }">
    @csrf
    @method('PUT')

    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <div>
            <x-input-label value="Logo" />
            @if (!empty($header['logo']))
                <img src="{{ \App\Support\CmsMedia::url($header['logo']) }}" alt="" class="mt-2 mb-2 h-16 object-contain bg-slate-800 rounded p-2">
            @endif
            <input type="file" name="logo" accept="image/*" class="mt-1 block w-full text-sm">
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-input-label value="CTA Label" />
                <x-text-input name="cta_label" class="mt-1 block w-full" :value="old('cta_label', $header['cta_label'] ?? '')" />
            </div>
            <div>
                <x-input-label value="CTA Link" />
                <x-text-input name="cta_href" class="mt-1 block w-full" :value="old('cta_href', $header['cta_href'] ?? '')" />
            </div>
        </div>
    </section>

    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Navigation Links</h2>
            <button type="button" class="text-sm text-indigo-600 hover:text-indigo-800" @click="links.push({label: '', url: ''})">Add link</button>
        </div>

        <template x-for="(link, index) in links" :key="index">
            <div class="grid gap-4 md:grid-cols-[1fr_1fr_auto] items-end border border-gray-100 rounded-md p-3">
                <div>
                    <x-input-label value="Label" />
                    <input type="text" :name="`nav_links[${index}][label]`" x-model="link.label" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <x-input-label value="URL" />
                    <input type="text" :name="`nav_links[${index}][url]`" x-model="link.url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <button type="button" class="mb-1 text-sm text-red-600 hover:text-red-800" @click="links.splice(index, 1)">Remove</button>
            </div>
        </template>
    </section>

    <div class="flex justify-end">
        <x-primary-button>Save Header</x-primary-button>
    </div>
</form>
@endsection
