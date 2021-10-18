<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FallecidoController;


//rutas historiales
Route::get('/api/fallecidos', [FallecidoController::class, 'ultimos_fallecidos']);
