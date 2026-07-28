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
        $this->cms->saveHome(
            $request->except(['_token', '_method']),
            $request->allFiles()
        );

        return back()->with('status', 'Home page content updated successfully.');
    }
}
