@extends('layouts.admin')

@section('heading', 'CMS — Gallery')

@section('content')
@php
    $initialItems = old('items', $gallery['items'] ?? []);
    if ($initialItems === []) {
        $initialItems = [['image' => '', 'alt' => '', 'preview' => '']];
    }
@endphp

<form
    method="POST"
    action="{{ route('admin.cms.gallery.update') }}"
    enctype="multipart/form-data"
    class="space-y-6 max-w-4xl"
    x-data="{ items: {{ Js::from($initialItems) }} }"
>
    @csrf
    @method('PUT')

    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">Page Content</h2>

        <div>
            <x-input-label value="Eyebrow (optional)" />
            <x-text-input name="eyebrow" class="mt-1 block w-full" :value="old('eyebrow', $gallery['eyebrow'] ?? '')" />
        </div>

        <div>
            <x-input-label value="Title" />
            <x-text-input name="title" class="mt-1 block w-full" :value="old('title', $gallery['title'] ?? '')" />
        </div>

        <div>
            <x-input-label value="Lead text" />
            <textarea name="lead" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('lead', $gallery['lead'] ?? '') }}</textarea>
        </div>
    </section>

    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <div class="flex items-center justify-between gap-3">
            <h2 class="text-lg font-semibold text-gray-900">Gallery Images</h2>
            <button
                type="button"
                class="text-sm text-indigo-600 hover:text-indigo-800"
                @click="items.push({ image: '', alt: '', preview: '' })"
            >
                Add image
            </button>
        </div>

        <p class="text-sm text-gray-500">
            Upload images here to show on the public Gallery page. Remove a row to delete it from the gallery.
        </p>

        <template x-for="(item, index) in items" :key="index">
            <div class="grid gap-4 md:grid-cols-[120px_1fr_auto] items-start border border-gray-100 rounded-md p-3">
                <div class="space-y-2">
                    <template x-if="item.preview || item.image">
                        <img
                            :src="item.preview || item.image"
                            alt=""
                            class="h-24 w-24 rounded object-cover border border-gray-200 bg-gray-50"
                        >
                    </template>
                    <template x-if="!(item.preview || item.image)">
                        <div class="h-24 w-24 rounded border border-dashed border-gray-300 bg-gray-50"></div>
                    </template>
                </div>

                <div class="space-y-3">
                    <input type="hidden" :name="`items[${index}][image]`" :value="item.image">

                    <div>
                        <x-input-label value="Alt text" />
                        <input
                            type="text"
                            :name="`items[${index}][alt]`"
                            x-model="item.alt"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Describe the image"
                        >
                    </div>

                    <div>
                        <x-input-label value="Replace / upload image" />
                        <input
                            type="file"
                            :name="`items[${index}][upload]`"
                            accept="image/*"
                            class="mt-1 block w-full text-sm"
                        >
                    </div>
                </div>

                <button
                    type="button"
                    class="text-sm text-red-600 hover:text-red-800"
                    @click="items.splice(index, 1)"
                >
                    Remove
                </button>
            </div>
        </template>
    </section>

    <div class="flex justify-end">
        <x-primary-button>Save Gallery</x-primary-button>
    </div>
</form>
@endsection
