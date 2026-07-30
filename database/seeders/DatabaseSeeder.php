<?php

namespace Database\Seeders;

use App\Models\CmsSection;
use App\Models\SiteSetting;
use App\Models\User;
use App\Services\CmsContentService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@janemansons.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $cms = app(CmsContentService::class);

        CmsSection::putContent('home', 'hero', $cms->defaultHero());
        CmsSection::putContent('home', 'about', $cms->defaultAbout());
        CmsSection::putContent('home', 'books', $cms->defaultBooks());
        CmsSection::putContent('home', 'stanzas', $cms->defaultStanzas());
        CmsSection::putContent('home', 'retail', $cms->defaultRetail());
        CmsSection::putContent('home', 'testimonials', $cms->defaultTestimonials());
        CmsSection::putContent('home', 'contact', $cms->defaultContact());
        CmsSection::putContent('header', 'main', $cms->defaultHeader());
        CmsSection::putContent('footer', 'main', $cms->defaultFooter());
        CmsSection::putContent('gallery', 'main', $cms->defaultGallery());

        SiteSetting::setValue('site_name', 'Jane Mansons', 'text', 'general', 'Site Name');
        SiteSetting::setValue(
            'meta_description',
            'Jane Mansons children’s books — stories about connection, friendship, and the power of love.',
            'textarea',
            'general',
            'Meta Description'
        );
        SiteSetting::setValue('contact_email', config('mail.contact_to', 'hello@example.com'), 'email', 'general', 'Contact Email');
    }
}
