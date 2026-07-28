@extends('layouts.admin')

@section('heading', 'CMS — Home')

@section('content')
@php
    $hero = $home['hero'];
    $about = $home['about'];
    $books = $home['books']['items'] ?? [];
    $stanzas = $home['stanzas'];
    $retail = $home['retail'];
    $testimonials = $home['testimonials'];
    $contact = $home['contact'];
@endphp

<form method="POST" action="{{ route('admin.cms.home.update') }}" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    {{-- Hero --}}
    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">Hero</h2>
        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <x-input-label for="hero_instagram" value="Instagram URL" />
                <x-text-input id="hero_instagram" name="hero[instagram_url]" class="mt-1 block w-full" :value="old('hero.instagram_url', $hero['instagram_url'] ?? '')" />
            </div>
            <div>
                <x-input-label for="hero_facebook" value="Facebook URL" />
                <x-text-input id="hero_facebook" name="hero[facebook_url]" class="mt-1 block w-full" :value="old('hero.facebook_url', $hero['facebook_url'] ?? '')" />
            </div>
            <div>
                <x-input-label for="hero_threads" value="Threads URL" />
                <x-text-input id="hero_threads" name="hero[threads_url]" class="mt-1 block w-full" :value="old('hero.threads_url', $hero['threads_url'] ?? '')" />
            </div>
        </div>
    </section>

    {{-- About --}}
    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">About the Author</h2>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-input-label for="about_eyebrow" value="Eyebrow" />
                <x-text-input id="about_eyebrow" name="about[eyebrow]" class="mt-1 block w-full" :value="old('about.eyebrow', $about['eyebrow'] ?? '')" />
            </div>
            <div>
                <x-input-label for="about_title" value="Title" />
                <x-text-input id="about_title" name="about[title]" class="mt-1 block w-full" :value="old('about.title', $about['title'] ?? '')" />
            </div>
        </div>
        <div>
            <x-input-label for="about_copy" value="Copy" />
            <textarea id="about_copy" name="about[copy]" rows="8" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('about.copy', $about['copy'] ?? '') }}</textarea>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-input-label for="about_button_label" value="Button Label" />
                <x-text-input id="about_button_label" name="about[button_label]" class="mt-1 block w-full" :value="old('about.button_label', $about['button_label'] ?? '')" />
            </div>
            <div>
                <x-input-label for="about_button_href" value="Button Link" />
                <x-text-input id="about_button_href" name="about[button_href]" class="mt-1 block w-full" :value="old('about.button_href', $about['button_href'] ?? '')" />
            </div>
        </div>
        <div>
            <x-input-label for="about_image" value="Author Image" />
            @if (!empty($about['image']))
                <div class="mt-2 mb-2">
                    <img src="{{ \App\Support\CmsMedia::url($about['image']) }}" alt="" class="h-24 rounded object-cover">
                </div>
            @endif
            <input id="about_image" type="file" name="about[image]" accept="image/*" class="mt-1 block w-full text-sm">
        </div>
        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <x-input-label value="Instagram URL" />
                <x-text-input name="about[instagram_url]" class="mt-1 block w-full" :value="old('about.instagram_url', $about['instagram_url'] ?? '')" />
            </div>
            <div>
                <x-input-label value="Facebook URL" />
                <x-text-input name="about[facebook_url]" class="mt-1 block w-full" :value="old('about.facebook_url', $about['facebook_url'] ?? '')" />
            </div>
            <div>
                <x-input-label value="Threads URL" />
                <x-text-input name="about[threads_url]" class="mt-1 block w-full" :value="old('about.threads_url', $about['threads_url'] ?? '')" />
            </div>
        </div>
    </section>

    {{-- Books --}}
    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-6">
        <h2 class="text-lg font-semibold text-gray-900">Books</h2>
        @foreach ($books as $index => $book)
            <div class="rounded-md border border-gray-200 p-4 space-y-4">
                <h3 class="font-medium text-gray-800">Book {{ $index + 1 }}</h3>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <x-input-label value="Label" />
                        <x-text-input name="books[items][{{ $index }}][label]" class="mt-1 block w-full" :value="old('books.items.'.$index.'.label', $book['label'] ?? '')" />
                    </div>
                    <div>
                        <x-input-label value="Title" />
                        <x-text-input name="books[items][{{ $index }}][title]" class="mt-1 block w-full" :value="old('books.items.'.$index.'.title', $book['title'] ?? '')" />
                    </div>
                </div>
                <div>
                    <x-input-label value="Copy" />
                    <textarea name="books[items][{{ $index }}][copy]" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('books.items.'.$index.'.copy', $book['copy'] ?? '') }}</textarea>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    <div>
                        <x-input-label value="Image Alt" />
                        <x-text-input name="books[items][{{ $index }}][image_alt]" class="mt-1 block w-full" :value="old('books.items.'.$index.'.image_alt', $book['image_alt'] ?? '')" />
                    </div>
                    <div>
                        <x-input-label value="Image Side" />
                        <select name="books[items][{{ $index }}][image_side]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="left" @selected(old('books.items.'.$index.'.image_side', $book['image_side'] ?? '') === 'left')>Left</option>
                            <option value="right" @selected(old('books.items.'.$index.'.image_side', $book['image_side'] ?? '') === 'right')>Right</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <x-input-label value="Width" />
                            <x-text-input name="books[items][{{ $index }}][image_width]" type="number" class="mt-1 block w-full" :value="old('books.items.'.$index.'.image_width', $book['image_width'] ?? 499)" />
                        </div>
                        <div>
                            <x-input-label value="Height" />
                            <x-text-input name="books[items][{{ $index }}][image_height]" type="number" class="mt-1 block w-full" :value="old('books.items.'.$index.'.image_height', $book['image_height'] ?? 622)" />
                        </div>
                    </div>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <x-input-label value="Button Label" />
                        <x-text-input name="books[items][{{ $index }}][button_label]" class="mt-1 block w-full" :value="old('books.items.'.$index.'.button_label', $book['button_label'] ?? '')" />
                    </div>
                    <div>
                        <x-input-label value="Button URL" />
                        <x-text-input name="books[items][{{ $index }}][button_href]" class="mt-1 block w-full" :value="old('books.items.'.$index.'.button_href', $book['button_href'] ?? '')" />
                    </div>
                </div>
                <div>
                    <x-input-label value="Cover Image" />
                    @if (!empty($book['image']))
                        <div class="mt-2 mb-2">
                            <img src="{{ \App\Support\CmsMedia::url($book['image']) }}" alt="" class="h-28 rounded object-contain bg-gray-50">
                        </div>
                    @endif
                    <input type="file" name="books[items][{{ $index }}][image]" accept="image/*" class="mt-1 block w-full text-sm">
                </div>
            </div>
        @endforeach
    </section>

    {{-- Stanzas --}}
    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">Stanzas</h2>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-input-label value="Eyebrow" />
                <x-text-input name="stanzas[eyebrow]" class="mt-1 block w-full" :value="old('stanzas.eyebrow', $stanzas['eyebrow'] ?? '')" />
            </div>
            <div>
                <x-input-label value="Heading" />
                <x-text-input name="stanzas[heading]" class="mt-1 block w-full" :value="old('stanzas.heading', $stanzas['heading'] ?? '')" />
            </div>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-input-label value="Left Art Image" />
                @if (!empty($stanzas['left_art']))
                    <img src="{{ \App\Support\CmsMedia::url($stanzas['left_art']) }}" alt="" class="mt-2 mb-2 h-24 object-contain">
                @endif
                <input type="file" name="stanzas[left_art]" accept="image/*" class="mt-1 block w-full text-sm">
            </div>
            <div>
                <x-input-label value="Right Art Image" />
                @if (!empty($stanzas['right_art']))
                    <img src="{{ \App\Support\CmsMedia::url($stanzas['right_art']) }}" alt="" class="mt-2 mb-2 h-24 object-contain">
                @endif
                <input type="file" name="stanzas[right_art]" accept="image/*" class="mt-1 block w-full text-sm">
            </div>
        </div>
        @foreach (($stanzas['cards'] ?? []) as $index => $card)
            <div class="rounded-md border border-gray-200 p-4 space-y-3">
                <h3 class="font-medium text-gray-800">Card {{ $index + 1 }}</h3>
                <x-text-input name="stanzas[cards][{{ $index }}][title]" class="block w-full" :value="old('stanzas.cards.'.$index.'.title', $card['title'] ?? '')" placeholder="Title" />
                <textarea name="stanzas[cards][{{ $index }}][body]" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Body">{{ old('stanzas.cards.'.$index.'.body', $card['body'] ?? '') }}</textarea>
                <x-text-input name="stanzas[cards][{{ $index }}][page]" class="block w-full" :value="old('stanzas.cards.'.$index.'.page', $card['page'] ?? '')" placeholder="Page label" />
            </div>
        @endforeach
    </section>

    {{-- Retail --}}
    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">Retail / Available On</h2>
        <div>
            <x-input-label value="Title" />
            <x-text-input name="retail[title]" class="mt-1 block w-full" :value="old('retail.title', $retail['title'] ?? '')" />
        </div>
        <div>
            <x-input-label value="Copy" />
            <textarea name="retail[copy]" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('retail.copy', $retail['copy'] ?? '') }}</textarea>
        </div>
        <div>
            <x-input-label value="Main Image" />
            @if (!empty($retail['image']))
                <img src="{{ \App\Support\CmsMedia::url($retail['image']) }}" alt="" class="mt-2 mb-2 h-24 object-contain">
            @endif
            <input type="file" name="retail[image]" accept="image/*" class="mt-1 block w-full text-sm">
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div class="space-y-3">
                <x-input-label value="Amazon URL" />
                <x-text-input name="retail[amazon_url]" class="mt-1 block w-full" :value="old('retail.amazon_url', $retail['amazon_url'] ?? '')" />
                <x-input-label value="Amazon Logo" />
                @if (!empty($retail['amazon_logo']))
                    <img src="{{ \App\Support\CmsMedia::url($retail['amazon_logo']) }}" alt="" class="mt-2 mb-2 h-16 object-contain">
                @endif
                <input type="file" name="retail[amazon_logo]" accept="image/*" class="block w-full text-sm">
            </div>
            <div class="space-y-3">
                <x-input-label value="Barnes & Noble URL" />
                <x-text-input name="retail[bn_url]" class="mt-1 block w-full" :value="old('retail.bn_url', $retail['bn_url'] ?? '')" />
                <x-input-label value="Barnes & Noble Logo" />
                @if (!empty($retail['bn_logo']))
                    <img src="{{ \App\Support\CmsMedia::url($retail['bn_logo']) }}" alt="" class="mt-2 mb-2 h-16 object-contain">
                @endif
                <input type="file" name="retail[bn_logo]" accept="image/*" class="block w-full text-sm">
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">Testimonials</h2>
        <div>
            <x-input-label value="Title" />
            <x-text-input name="testimonials[title]" class="mt-1 block w-full" :value="old('testimonials.title', $testimonials['title'] ?? '')" />
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-input-label value="Video" />
                <p class="text-xs text-gray-500 mt-1 mb-1">Current: {{ $testimonials['video'] ?? '—' }}</p>
                <input type="file" name="testimonials[video]" accept="video/*" class="block w-full text-sm">
            </div>
            <div>
                <x-input-label value="Poster Image" />
                @if (!empty($testimonials['poster']))
                    <img src="{{ \App\Support\CmsMedia::url($testimonials['poster']) }}" alt="" class="mt-2 mb-2 h-20 object-cover rounded">
                @endif
                <input type="file" name="testimonials[poster]" accept="image/*" class="block w-full text-sm">
            </div>
            <div>
                <x-input-label value="Yarn Decoration" />
                @if (!empty($testimonials['deco_yarn']))
                    <img src="{{ \App\Support\CmsMedia::url($testimonials['deco_yarn']) }}" alt="" class="mt-2 mb-2 h-16 object-contain">
                @endif
                <input type="file" name="testimonials[deco_yarn]" accept="image/*" class="block w-full text-sm">
            </div>
            <div>
                <x-input-label value="Glasses Decoration" />
                @if (!empty($testimonials['deco_glasses']))
                    <img src="{{ \App\Support\CmsMedia::url($testimonials['deco_glasses']) }}" alt="" class="mt-2 mb-2 h-16 object-contain">
                @endif
                <input type="file" name="testimonials[deco_glasses]" accept="image/*" class="block w-full text-sm">
            </div>
        </div>

        @foreach (($testimonials['items'] ?? []) as $index => $item)
            <div class="rounded-md border border-gray-200 p-4 space-y-3">
                <h3 class="font-medium text-gray-800">Testimonial {{ $index + 1 }}</h3>
                <div class="grid gap-4 md:grid-cols-2">
                    <x-text-input name="testimonials[items][{{ $index }}][name]" class="block w-full" :value="old('testimonials.items.'.$index.'.name', $item['name'] ?? '')" placeholder="Name" />
                    <x-text-input name="testimonials[items][{{ $index }}][headline]" class="block w-full" :value="old('testimonials.items.'.$index.'.headline', $item['headline'] ?? '')" placeholder="Headline" />
                </div>
                <textarea name="testimonials[items][{{ $index }}][quote]" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Quote">{{ old('testimonials.items.'.$index.'.quote', $item['quote'] ?? '') }}</textarea>
                @if (!empty($item['avatar']))
                    <img src="{{ \App\Support\CmsMedia::url($item['avatar']) }}" alt="" class="h-12 w-12 rounded-full object-cover">
                @endif
                <input type="file" name="testimonials[items][{{ $index }}][avatar]" accept="image/*" class="block w-full text-sm">
            </div>
        @endforeach
    </section>

    {{-- Contact --}}
    <section class="rounded-lg bg-white shadow-sm border border-gray-200 p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-900">Contact</h2>
        <div>
            <x-input-label value="Title" />
            <x-text-input name="contact[title]" class="mt-1 block w-full" :value="old('contact.title', $contact['title'] ?? '')" />
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-input-label value="Button Label" />
                <x-text-input name="contact[button_label]" class="mt-1 block w-full" :value="old('contact.button_label', $contact['button_label'] ?? '')" />
            </div>
            <div>
                <x-input-label value="Button Link" />
                <x-text-input name="contact[button_href]" class="mt-1 block w-full" :value="old('contact.button_href', $contact['button_href'] ?? '')" />
            </div>
        </div>
        <div>
            <x-input-label value="Image" />
            @if (!empty($contact['image']))
                <img src="{{ \App\Support\CmsMedia::url($contact['image']) }}" alt="" class="mt-2 mb-2 h-24 object-contain">
            @endif
            <input type="file" name="contact[image]" accept="image/*" class="mt-1 block w-full text-sm">
        </div>
    </section>

    <div class="flex justify-end">
        <x-primary-button>Save Home Page</x-primary-button>
    </div>
</form>
@endsection
