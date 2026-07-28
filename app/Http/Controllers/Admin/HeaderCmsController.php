<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeaderCmsController extends Controller
{
    public function __construct(private readonly CmsContentService $cms) {}

    public function edit(): View
    {
        return view('admin.cms.header', [
            'header' => $this->cms->header(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $this->cms->saveHeader(
            $request->except(['_token', '_method']),
            $request->allFiles()
        );

        return back()->with('status', 'Header content updated successfully.');
    }
}
