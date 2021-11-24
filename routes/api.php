<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('usuarios')-> group(function(){

    Route::put('/crear', [PersonasController::class, 'crear']);
    Route::post('/desactivar/{id}', [PersonasController::class, 'desactivar']);
    Route::post('/editar/{id}', [PersonasController::class, 'editar']);
    //Route::get('/ver/{id}', [PersonasController::class, 'ver']);

});
