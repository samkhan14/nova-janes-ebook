@extends('layouts.admin')

@section('heading', 'CMS — Footer')

@section('content')
<form method="POST" action="{{ route('admin.cms.footer.update') }}" class="max-w-3xl space-y-6">
    @csrf
    @method('PUT')

    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <div>
            <x-input-label for="copyright" value="Copyright Text" />
            <p class="mt-1 text-xs text-gray-500">Use <code>{year}</code> to insert the current year automatically.</p>
            <textarea id="copyright" name="copyright" rows="3" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('copyright', $footer['copyright'] ?? '') }}</textarea>
        </div>
    </section>

    <div class="flex justify-end">
        <x-primary-button>Save Footer</x-primary-button>
    </div>
</form>
@endsection
