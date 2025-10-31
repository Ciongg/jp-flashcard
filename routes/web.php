<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/katakana', function () {
    return Inertia::render('Katakana');
})->name('katakana');

Route::get('/hiragana', function () {
    return Inertia::render('Hiragana');
})->name('hiragana');
