<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FallecidoController;


// rutas de usuario
Route::get('/api/usuarios', [UsuarioController::class, 'lista']);


//rutas historiales
Route::get('/api/fallecidos', [FallecidoController::class, 'ultimos_fallecidos']);