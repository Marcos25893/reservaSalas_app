<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Sala;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index(){
        //Mostrar todas las reservas del usuario logueado
        $user = auth()->user();
        $reservas = $user->reservas;

        return view('reservas.index', compact('reservas', 'user'));
    }


    public function new(){
        return view('reservas.new');
    }

    public function store(){
        echo "crear reserva";
    }

    public function buscarDisponibilidad(Request $request)  {
        //Validar datos del formulario
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'numpersonas' => 'required|integer|min:1',
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $num_personas = $request->input('numpersonas');

        //Lógica para buscar disponibilidad de salas
        // Obtener todas las mesas
        $sala = Sala::where('capacidad', '>=', $num_personas)
                        ->where('capacidad', '<=', 2 + ($num_personas))->get();

        // Filtrar salas ocupadas en esa fecha y hora
        $ocupadas = Reserva::where('fecha', $fecha)
            ->where('hora', $hora)
            ->pluck('sala_id')  // Obtener solo los IDs de las salas ocupadas
            ->toArray();

        // Salas libres
        $libres = $sala->whereNotIn('id', $ocupadas);

        return view('reservas.search', compact('libres', 'fecha', 'hora', 'num_personas'));

    }
}
