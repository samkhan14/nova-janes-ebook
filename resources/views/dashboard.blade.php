@extends('layouts.admin')

@section('heading', 'Dashboard')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <a href="{{ route('admin.cms.home.edit') }}" class="rounded-lg bg-white p-6 shadow-sm border border-gray-200 hover:border-indigo-300 transition">
            <h2 class="font-semibold text-gray-900">CMS — Home</h2>
            <p class="mt-2 text-sm text-gray-600">Edit hero, about, books, stanzas, retail, testimonials, and contact sections.</p>
        </a>
        <a href="{{ route('admin.cms.header.edit') }}" class="rounded-lg bg-white p-6 shadow-sm border border-gray-200 hover:border-indigo-300 transition">
            <h2 class="font-semibold text-gray-900">CMS — Header</h2>
            <p class="mt-2 text-sm text-gray-600">Manage logo, navigation links, and header CTA.</p>
        </a>
        <a href="{{ route('admin.cms.footer.edit') }}" class="rounded-lg bg-white p-6 shadow-sm border border-gray-200 hover:border-indigo-300 transition">
            <h2 class="font-semibold text-gray-900">CMS — Footer</h2>
            <p class="mt-2 text-sm text-gray-600">Update copyright and footer text.</p>
        </a>
        <a href="{{ route('admin.cms.gallery.edit') }}" class="rounded-lg bg-white p-6 shadow-sm border border-gray-200 hover:border-indigo-300 transition">
            <h2 class="font-semibold text-gray-900">CMS — Gallery</h2>
            <p class="mt-2 text-sm text-gray-600">Manage gallery page title, lead text, and images.</p>
        </a>
        <a href="{{ route('admin.settings.site.edit') }}" class="rounded-lg bg-white p-6 shadow-sm border border-gray-200 hover:border-indigo-300 transition">
            <h2 class="font-semibold text-gray-900">Site Settings</h2>
            <p class="mt-2 text-sm text-gray-600">Site name, meta description, and contact email.</p>
        </a>
    </div>
@endsection
