<?php

use Illuminate\Support\Facades\Route;

Route::get('/about', function () {
    return Inertia::render('About', [
        'company' => 'Hassi Properties',
    ]);
});

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
