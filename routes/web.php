<?php

use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Rutas Protege el HOME
Route::middleware(['auth'])->group(function () {
    //Una vez logueado o registrado
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    //Mostrar reservas propias
    Route::get('/mis-reservas', [ReservaController::class, 'index'])->name('mis-reservas');

    //Mostrar formulario para nueva reserva

    Route::get('/nueva-reserva', [ReservaController::class, 'new'])->name('nueva-reserva');
});
