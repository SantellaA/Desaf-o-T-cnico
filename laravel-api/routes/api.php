<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\espacioController;
use App\Http\Controllers\Api\roleController;

// Espacios
    Route::get('/espacios', [espacioController::class, 'list']);
    Route::get('/espacios/{id}', [espacioController::class, 'get']);
    Route::post('/espacios', [espacioController::class, 'create']);
    Route::put('/espacios/{id}', [espacioController::class, 'update']);
    Route::delete('/espacios/{id}', [espacioController::class, 'delete']);

//reservas
    Route::get('/reserva', function () {
        return "listado de reservas";
    });

//usuarios
    Route::get('/usuarios', function () {
        return "listado de usuarios";
    });

//roles
    Route::get('/roles', [roleController::class, 'list']);
    Route::get('/roles/{id}', [roleController::class, 'get']);

    