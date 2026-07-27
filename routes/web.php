<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/my-books', [HomeController::class, 'books'])->name('books.index');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');
