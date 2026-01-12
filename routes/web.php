<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KupacController;
use App\Http\Controllers\NekretninaController;
use App\Http\Controllers\ProdajaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Breeze profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tvoje rute (CRUD)
    Route::resource('kupci', KupacController::class);
    Route::resource('nekretnine', NekretninaController::class);
    Route::resource('prodaje', ProdajaController::class);
});

require __DIR__.'/auth.php';
