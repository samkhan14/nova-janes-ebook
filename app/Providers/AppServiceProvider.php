<?php

namespace App\Providers;

use App\Payments\Contracts\PaymentGatewayInterface;
use App\Payments\PayPal\PayPalGateway;
use App\Services\CmsContentService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Swap this binding later if you add Stripe, etc.
        $this->app->bind(PaymentGatewayInterface::class, PayPalGateway::class);
    }

    public function boot(): void
    {
        View::composer(['components.site.header', 'home', 'books', 'shop.*', 'components.site.shop-bar'], function ($view) {
            if (! $view->offsetExists('header')) {
                $view->with('header', app(CmsContentService::class)->header());
            }

            if (! $view->offsetExists('footer')) {
                $view->with('footer', app(CmsContentService::class)->footer());
            }
        });
    }
}
