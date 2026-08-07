<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Services\CmsContentService;
use App\Support\CmsMedia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function __construct(private readonly CmsContentService $cms) {}

    public function index(): View
    {
        $printBooks = Product::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'title', 'slug', 'cover_image', 'tag']);

        return view('home', [
            'home' => $this->cms->home(),
            'header' => $this->cms->header(),
            'footer' => $this->cms->footer(),
            'printBooks' => $printBooks,
            'metaDescription' => SiteSetting::getValue(
                'meta_description',
                'Jane Mansons children’s books — stories about connection, friendship, and the power of love.'
            ),
        ]);
    }

    public function books(): RedirectResponse
    {
        return redirect()->route('books.index');
    }

    public function gallery(): View
    {
        $gallery = $this->cms->gallery();

        $images = collect($gallery['items'] ?? [])
            ->filter(fn ($item) => filled($item['image'] ?? null))
            ->map(fn ($item) => [
                'src' => CmsMedia::url($item['image']),
                'alt' => $item['alt'] ?? '',
            ])
            ->values()
            ->all();

        return view('gallery', [
            'header' => $this->cms->header(),
            'footer' => $this->cms->footer(),
            'gallery' => $gallery,
            'images' => $images,
            'metaDescription' => SiteSetting::getValue(
                'meta_description',
                'Gallery — moments, characters, and artwork from Jane Mansons’ Benny stories.'
            ),
        ]);
    }

    public function contact(ContactRequest $request): JsonResponse|RedirectResponse
    {
        $payload = $request->validated();
        $message = 'Thank you. Your message has been received.';
        $to = SiteSetting::getValue('contact_email') ?: config('mail.contact_to');

        try {
            Mail::to($to)->send(new ContactFormMail($payload));
        } catch (Throwable $exception) {
            report($exception);

            $error = 'Unable to send your message right now. Please try again later.';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $error,
                ], 500);
            }

            return back()->withErrors(['contact' => $error])->withInput();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return back()->with('contact_status', $message);
    }
}
