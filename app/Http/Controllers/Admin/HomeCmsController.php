<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsContentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeCmsController extends Controller
{
    public function __construct(private readonly CmsContentService $cms) {}

    public function edit(): View
    {
        return view('admin.cms.home', [
            'home' => $this->cms->home(),
        ]);
    }

    public function update(Request $request): JsonResponse|RedirectResponse
    {
        $files = $request->allFiles();

        // Nested avatar uploads: testimonials[items][N][avatar_upload]
        foreach ($request->input('testimonials.items', []) as $index => $item) {
            $avatar = $request->file("testimonials.items.$index.avatar_upload");
            if ($avatar) {
                $files['testimonials']['items'][$index]['avatar_upload'] = $avatar;
            }
        }

        $this->cms->saveHome(
            $request->except(['_token', '_method']),
            $files
        );

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Home page content updated successfully.',
            ]);
        }

        return back()->with('status', 'Home page content updated successfully.');
    }
}
