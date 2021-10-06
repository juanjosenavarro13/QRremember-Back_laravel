<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoryController;


// rutas de usuario
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);

//rutas admin
Route::post('/api/admin/lista_users', [UserController::class, 'admin_lista_users']);

//rutas historiales
Route::get('/api/ultimos_fallecidos', [HistoryController::class, 'ultimos_fallecidos']);