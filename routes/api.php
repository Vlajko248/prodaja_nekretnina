<?php

use App\Http\Controllers\Api\KupacApiController;
use App\Http\Controllers\Api\AgentApiController;
use App\Http\Controllers\Api\NekretninaApiController;
use App\Http\Controllers\Api\ProdajaApiController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::apiResource('kupci', KupacApiController::class);
    Route::apiResource('agenti', AgentApiController::class);
    Route::apiResource('nekretnine', NekretninaApiController::class);
    Route::apiResource('prodaje', ProdajaApiController::class);
});
