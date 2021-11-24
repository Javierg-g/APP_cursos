<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('usuarios')-> group(function(){

    Route::put('/crear', [UsuariosController::class, 'crear']);
    Route::post('/desactivar/{id}', [UsuariosController::class, 'desactivar']);
    Route::post('/editar/{id}', [UsuariosController::class, 'editar']);
    Route::get('/ver/{id}', [UsuariosController::class, 'ver']);

});
