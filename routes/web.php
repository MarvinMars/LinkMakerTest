<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::resource('links', LinkController::class)->only(['create', 'store']);

Route::get('/{short_link}', [LinkController::class, 'redirect'])->name('links.redirect');
