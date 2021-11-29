<?php

use App\Http\Controllers\CursosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VideosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('usuarios')-> group(function(){

    Route::put('/registrar', [UsuariosController::class, 'registrar']);
    Route::post('/desactivar/{id}', [UsuariosController::class, 'desactivar']);
    Route::post('/editar/{id}', [UsuariosController::class, 'editar']);
    Route::get('/ver/{id}', [UsuariosController::class, 'ver']);
    Route::put('/unirse', [UsuariosController::class, 'unirse']);

});

Route::prefix('cursos')-> group(function(){

    Route::put('/crear', [CursosController::class, 'crear']);
    Route::get('/listar', [CursosController::class, 'listar']);

});

Route::prefix('videos')-> group(function(){

    Route::put('/crear', [VideosController::class, 'crear']);
    Route::get('/listar', [VideosController::class, 'listar']);

});

