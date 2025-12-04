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

    //Buscar disponibilidad para una nueva reserva
    Route::post('/buscar-disponibilidad', [ReservaController::class, 'buscarDisponibilidad'])->name('reservas.buscar');

    Route::post('/crear-reserva', [ReservaController::class, 'store'])->name('reservas.store');

    Route::get('/mis-reservas/{reserva}/cancelarReserva', [ReservaController::class, 'cancelarReserva'])->name('reservas.cancelar');
});

//Rutasa protegidas por login y admin
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/reservas/pendientes', [ReservaController::class, 'pendientes'])->name('reservas.pendientes');
    Route::post('/reservas/filtrar', [ReservaController::class, 'filtrar'])->name('reservas.filtrar');

    Route::get('/reservas/{reserva}/confirmarReserva', [ReservaController::class, 'confirmarReserva'])->name('reservas.confirmar');
});
