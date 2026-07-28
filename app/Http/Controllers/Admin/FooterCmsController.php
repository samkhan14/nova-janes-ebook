<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FooterCmsController extends Controller
{
    public function __construct(private readonly CmsContentService $cms) {}

    public function edit(): View
    {
        return view('admin.cms.footer', [
            'footer' => $this->cms->footer(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'copyright' => ['required', 'string', 'max:500'],
        ]);

        $this->cms->saveFooter($request->only('copyright'));

        return back()->with('status', 'Footer content updated successfully.');
    }
}
