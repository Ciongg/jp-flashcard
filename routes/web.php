<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/flashcard', function (Request $request) {
    $selectedCharacters = json_decode($request->query('selectedCharacters', '[]'), true);
    return Inertia::render('Flashcard', [
        'selectedCharacters' => $selectedCharacters,
    ]);
})->name('flashcard');

Route::get('/writing-flashcard', function (Request $request) {
    $selectedCharacters = json_decode($request->query('selectedCharacters', '[]'), true);
    return Inertia::render('WritingFlashcard', [
        'selectedCharacters' => $selectedCharacters,
    ]);
})->name('writing-flashcard');
