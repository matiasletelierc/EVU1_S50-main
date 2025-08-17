<?php

use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Rutas de autenticación
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/proyectos',[ProyectoController::class, 'getProyectos']);

Route::get('/proyecto/{id}', [ProyectoController::class, 'getProyecto']);

Route::post('/proyecto/{id}/{nombre}/{fechaInicio}/{estado}/{responsable}/{monto}', [ProyectoController::class, 'postProyecto']);

Route::delete('/proyecto/{id}', [ProyectoController::class, 'deleteProyecto']);

Route::put('/proyecto/{id}', [ProyectoController::class, 'putProyecto']);

