<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FallecidoController;


// rutas de usuario
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);
Route::get('/api/usuarios', [UserController::class, 'lista']);


//rutas historiales
Route::get('/api/fallecidos', [FallecidoController::class, 'ultimos_fallecidos']);