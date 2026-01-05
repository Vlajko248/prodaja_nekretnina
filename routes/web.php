<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('kupacs', App\Http\Controllers\KupacController::class);

Route::resource('agents', App\Http\Controllers\AgentController::class);

Route::resource('nekretninas', App\Http\Controllers\NekretninaController::class);

Route::resource('prodajas', App\Http\Controllers\ProdajaController::class);
