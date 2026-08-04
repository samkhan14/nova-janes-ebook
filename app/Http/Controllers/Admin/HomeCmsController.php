<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsContentService;
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

    public function update(Request $request): RedirectResponse
    {
        $files = $request->allFiles();

        // Nested file inputs (testimonials[items][N][avatar]) are more reliable via file()
        foreach ($request->input('testimonials.items', []) as $index => $item) {
            $avatar = $request->file("testimonials.items.$index.avatar");
            if ($avatar) {
                $files['testimonials']['items'][$index]['avatar'] = $avatar;
            }
        }

        $this->cms->saveHome(
            $request->except(['_token', '_method']),
            $files
        );

        return back()->with('status', 'Home page content updated successfully.');
    }
}
