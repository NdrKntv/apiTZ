<?php

use App\Http\Controllers\API\PositionsController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get('token', VisitorController::class);

Route::get('positions', [PositionsController::class, 'index']);

Route::apiResource('users', UserController::class)->except(['update', 'destroy']);
