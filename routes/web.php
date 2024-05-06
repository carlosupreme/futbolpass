<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/qr-test', function () {
        return view('qr-test');
    })->name('qr-test');

    Route::get('/ligas', static fn() => view('league.index'))->name('league.index');

    Route::get('/ligas/{id}', static fn($id) => view('league.show', ['league' => \App\Models\League::findOrFail($id)]))->name('league.show');
});
