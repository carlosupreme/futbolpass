<?php

use App\Models\League;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/jugadores/{id}', static fn($id) => view('player.show', compact('id')))->name('player.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/ligas');
    })->name('dashboard');

    Route::get('/tomar-asistencia', function () {
        return view('qr-test');
    })->name('attendance.scan');

    Route::get('/ligas', static fn() => view('league.index'))->name('league.index');

    Route::get('/ligas/{id}', static fn($id) => view('league.show', [
        'league' => League::findOrFail($id)
    ]))->name('league.show');

    Route::get('/temporada/{id}', static fn($id) => view('season.show', [
        'season' => Season::with('league','teams')->findOrFail($id)
    ]))->name('season.show');

    //Route::get('/jugadores', static fn() => view('player.index'))->name('player.index');

    // Route::get('/jugadores/{id}', static fn($id) => view('player.show', [
    //     'player' => Player::findOrFail($id)
    // ]))->name('player.show');

    Route::get('/equipo/{id}', static fn($id) => view('team.show', ['id' => $id]))->name('team.show');

    Route::get('/jugadores', static fn() => view('player.index'))->name('player.index');
});
