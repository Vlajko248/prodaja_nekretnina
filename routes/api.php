<?php

use App\Http\Controllers\Api\KupacApiController;
use App\Http\Controllers\Api\AgentApiController;
use App\Http\Controllers\Api\NekretninaApiController;
use App\Http\Controllers\Api\ProdajaApiController;

Route::apiResource('kupci', KupacApiController::class);
Route::apiResource('agenti', AgentApiController::class);
Route::apiResource('nekretnine', NekretninaApiController::class);
Route::apiResource('prodaje', ProdajaApiController::class);
