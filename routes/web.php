<?php

use App\Http\Controllers\Admin\FooterCmsController;
use App\Http\Controllers\Admin\GalleryCmsController;
use App\Http\Controllers\Admin\HeaderCmsController;
use App\Http\Controllers\Admin\HomeCmsController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery.index');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');
Route::get('/media/{path}', [MediaController::class, 'show'])
    ->where('path', '.*')
    ->name('media.show');

/*
| Print shop
| My Books → book page → cart → checkout → thank you
| Paperback + hardcover only. Ebook = Amazon link.
*/
Route::get('/my-books', [ShopController::class, 'books'])->name('books.index');
Route::get('/my-books/{product:slug}', [ShopController::class, 'book'])->name('books.show');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart.index');
Route::post('/cart', [ShopController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/{variant}', [ShopController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/{variant}', [ShopController::class, 'removeFromCart'])->name('cart.destroy');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout.create');
Route::post('/checkout/paypal/create', [ShopController::class, 'createPaypalOrder'])->name('checkout.paypal.create');
Route::post('/checkout/paypal/capture', [ShopController::class, 'capturePaypalOrder'])->name('checkout.paypal.capture');
Route::get('/checkout/success/{order:order_number}', [ShopController::class, 'thankYou'])->name('checkout.success');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/cms/home', [HomeCmsController::class, 'edit'])->name('cms.home.edit');
    Route::put('/cms/home', [HomeCmsController::class, 'update'])->name('cms.home.update');

    Route::get('/cms/header', [HeaderCmsController::class, 'edit'])->name('cms.header.edit');
    Route::put('/cms/header', [HeaderCmsController::class, 'update'])->name('cms.header.update');

    Route::get('/cms/footer', [FooterCmsController::class, 'edit'])->name('cms.footer.edit');
    Route::put('/cms/footer', [FooterCmsController::class, 'update'])->name('cms.footer.update');

    Route::get('/cms/gallery', [GalleryCmsController::class, 'edit'])->name('cms.gallery.edit');
    Route::put('/cms/gallery', [GalleryCmsController::class, 'update'])->name('cms.gallery.update');

    Route::get('/settings/site', [SiteSettingsController::class, 'edit'])->name('settings.site.edit');
    Route::put('/settings/site', [SiteSettingsController::class, 'update'])->name('settings.site.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
