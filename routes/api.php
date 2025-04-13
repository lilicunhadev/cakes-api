<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BoloController;

Route::apiResource('bolos', BoloController::class);
