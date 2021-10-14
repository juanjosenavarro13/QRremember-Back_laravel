<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;


// rutas de usuario
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);
Route::get('/api/usuarios', [UserController::class, 'lista']);


//rutas historiales
Route::get('/api/ultimos_fallecidos', [HistoryController::class, 'ultimos_fallecidos']);