<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\espacioController;
use App\Http\Controllers\Api\reservaController;
use App\Http\Controllers\Api\roleController;
use App\Http\Controllers\Api\userController;

// Espacios
    Route::get('/espacios', [espacioController::class, 'list']);
    Route::get('/espacios/{id}', [espacioController::class, 'get']);
    Route::post('/espacios', [espacioController::class, 'create']);
    Route::put('/espacios/{id}', [espacioController::class, 'update']);
    Route::delete('/espacios/{id}', [espacioController::class, 'delete']);

//reservas
    Route::get('/reserva', [reservaController::class, 'list']);
    Route::get('/reserva/{id}', [reservaController::class, 'get']);
    Route::post('/reserva', [reservaController::class, 'create']);
    Route::delete('/reserva/{id}', [reservaController::class, 'delete']);

//usuarios
    Route::get('/user', [userController::class, 'list']);
    Route::get('/user/{id}', [userController::class, 'get']);
    Route::post('/user', [userController::class, 'create']);
    Route::put('/user/{id}', [userController::class, 'update']);
    Route::delete('/user/{id}', [userController::class, 'delete']);

//roles
    Route::get('/roles', [roleController::class, 'list']);
    Route::get('/roles/{id}', [roleController::class, 'get']);

    