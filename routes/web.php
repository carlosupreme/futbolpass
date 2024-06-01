<?php

use App\Models\League;
use App\Models\Player;
use App\Models\Season;
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

    Route::get('/attendance-list', function () {
        return view('qr-test');
    })->name('qr-test');

    Route::get('/ligas', static fn() => view('league.index'))->name('league.index');

    Route::get('/ligas/{id}', static fn($id) => view('league.show', [
        'league' => League::findOrFail($id)
    ]))->name('league.show');

    Route::get('/temporada/{id}', static fn($id) => view('season.show', [
        'season' => Season::with('league','teams')->findOrFail($id)
    ]))->name('season.show');

    Route::get('/jugadores', static fn() => view('player.index'))->name('player.index');

    Route::get('/jugadores/{id}', static fn($id) => view('player.show', [
        'player' => Player::findOrFail($id)
    ]))->name('player.show');
    
});
