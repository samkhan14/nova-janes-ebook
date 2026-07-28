<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use App\Models\SiteSetting;
use App\Services\CmsContentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function __construct(private readonly CmsContentService $cms) {}

    public function index(): View
    {
        return view('home', [
            'home' => $this->cms->home(),
            'header' => $this->cms->header(),
            'footer' => $this->cms->footer(),
            'metaDescription' => SiteSetting::getValue(
                'meta_description',
                'Jane Mansons children’s books — stories about connection, friendship, and the power of love.'
            ),
        ]);
    }

    public function books(): View
    {
        return view('books', [
            'header' => $this->cms->header(),
            'footer' => $this->cms->footer(),
            'metaDescription' => SiteSetting::getValue(
                'meta_description',
                'Jane Mansons children’s books — stories about connection, friendship, and the power of love.'
            ),
        ]);
    }

    public function gallery(): View
    {
        return view('gallery', [
            'header' => $this->cms->header(),
            'footer' => $this->cms->footer(),
            'metaDescription' => SiteSetting::getValue(
                'meta_description',
                'Gallery — moments, characters, and artwork from Jane Mansons’ Benny stories.'
            ),
            'images' => $this->galleryImages(),
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

    /**
     * @return list<array{src: string, alt: string}>
     */
    private function galleryImages(): array
    {
        $directory = public_path('frontend/assets/images/gallery');

        if (! File::isDirectory($directory)) {
            return [];
        }

        $extensions = ['jpg', 'jpeg', 'jfif', 'png', 'webp', 'gif', 'avif'];

        return collect(File::files($directory))
            ->filter(fn ($file) => in_array(strtolower($file->getExtension()), $extensions, true))
            ->sortBy(fn ($file) => Str::lower($file->getFilename()))
            ->values()
            ->map(function ($file) {
                $name = $file->getFilename();

                return [
                    'src' => 'frontend/assets/images/gallery/'.$name,
                    'alt' => Str::of(pathinfo($name, PATHINFO_FILENAME))
                        ->replace(['-', '_'], ' ')
                        ->title()
                        ->toString(),
                ];
            })
            ->all();
    }
}
