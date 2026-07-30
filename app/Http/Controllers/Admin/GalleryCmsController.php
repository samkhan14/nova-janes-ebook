<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryCmsController extends Controller
{
    public function __construct(private readonly CmsContentService $cms) {}

    public function edit(): View
    {
        $gallery = $this->cms->gallery();

        $gallery['items'] = collect($gallery['items'] ?? [])
            ->map(fn ($item) => [
                'image' => $item['image'] ?? '',
                'alt' => $item['alt'] ?? '',
                'preview' => \App\Support\CmsMedia::url($item['image'] ?? null) ?? '',
            ])
            ->values()
            ->all();

        return view('admin.cms.gallery', [
            'gallery' => $gallery,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $this->cms->saveGallery(
            $request->except(['_token', '_method']),
            $request->allFiles()
        );

        return back()->with('status', 'Gallery content updated successfully.');
    }
}
