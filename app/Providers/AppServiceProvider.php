<?php

namespace App\Providers;

use App\Services\CmsContentService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['components.site.header', 'home', 'books'], function ($view) {
            if (! $view->offsetExists('header')) {
                $view->with('header', app(CmsContentService::class)->header());
            }

            if (! $view->offsetExists('footer')) {
                $view->with('footer', app(CmsContentService::class)->footer());
            }
        });
    }
}
