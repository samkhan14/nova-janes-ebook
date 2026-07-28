<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\CmsMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingsController extends Controller
{
    public function edit(): View
    {
        $settings = SiteSetting::query()->orderBy('group')->orderBy('key')->get()->keyBy('key');

        return view('admin.settings.site', [
            'settings' => $settings,
            'values' => [
                'site_name' => SiteSetting::getValue('site_name', config('app.name')),
                'meta_description' => SiteSetting::getValue('meta_description', 'Jane Mansons children’s books — stories about connection, friendship, and the power of love.'),
                'contact_email' => SiteSetting::getValue('contact_email', config('mail.contact_to')),
                'favicon' => SiteSetting::getValue('favicon'),
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:150'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'contact_email' => ['nullable', 'email', 'max:150'],
            'favicon' => ['nullable', 'image', 'max:2048'],
        ]);

        SiteSetting::setValue('site_name', $validated['site_name'], 'text', 'general', 'Site Name');
        SiteSetting::setValue('meta_description', $validated['meta_description'] ?? '', 'textarea', 'general', 'Meta Description');
        SiteSetting::setValue('contact_email', $validated['contact_email'] ?? '', 'email', 'general', 'Contact Email');

        if ($request->hasFile('favicon')) {
            $path = CmsMedia::store($request->file('favicon'), 'cms/settings');
            SiteSetting::setValue('favicon', $path, 'image', 'general', 'Favicon');
        }

        return back()->with('status', 'Site settings updated successfully.');
    }
}
