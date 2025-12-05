<?php

use App\Http\Controllers\ReservaController;
use App\Http\Resources\SalaResource;
use App\Models\Reserva;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Ruta para generar token(No esta protegida)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    //Comprobar credenciales
    if (!Auth::attempt($credentials)) {
        abort(401);
    }

    $token = Auth::user()->createToken('my-app-token')->plainTextToken;

    return response()->json(['token' => $token, 'user' => Auth::user()]);
});


//Rutas Protegidas
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/salas', [ReservaController::class, 'apiGetSalas']);

    Route::get('/salas/{id}', [ReservaController::class, 'GetSalaById']);

    Route::get('/reservas/admin', [ReservaController::class, 'GetReservasAdmin']);

    Route::get('/reservas', [ReservaController::class, 'GetReservasUser']);

    Route::get('/reservas/{id}', [ReservaController::class, 'getReservasById']);

    Route::post('/reservas', [ReservaController::class, 'apiNewReserva']);

    Route::put('/reservas/{id}', [ReservaController::class, 'apiUpdateReserva']);

    Route::delete('/reservas/{id}', [ReservaController::class, 'apiDeleteReserva']);
});

