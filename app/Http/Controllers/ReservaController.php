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

    public function store(Request $request){
        $sala_id=$request->input('sala_id');
        $telefono=$request->input('telefono');
        $fecha=$request->input('fecha');
        $hora=$request->input('hora');
        $numpersonas=$request->input('numpersonas');

        Reserva::create([
            'sala_id' => $sala_id,
            'telefono' => $telefono,
            'fecha' => $fecha,
            'hora' => $hora,
            'numpersonas' => $numpersonas,
            'estado' => 'pendiente',
            'user_id' => auth()->id()
        ]);

        return redirect('mis-reservas');

    }

    public function buscarDisponibilidad(Request $request)  {
        //Validar datos del formulario
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'numpersonas' => 'required|integer|min:1',
            'telefono' => 'required|string|min:9',
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $numpersonas = $request->input('numpersonas');
        $telefono = $request->input('telefono');


        //Lógica para buscar disponibilidad de salas
        // Obtener todas las mesas
        $sala = Sala::where('capacidad', '>=', $numpersonas)
                        ->where('capacidad', '<=', 2 + ($numpersonas))->get();

        // Filtrar salas ocupadas en esa fecha y hora
        $ocupadas = Reserva::where('fecha', $fecha)
            ->where('hora', $hora)
            ->pluck('sala_id')  // Obtener solo los IDs de las salas ocupadas
            ->toArray();

        // Salas libres
        $libres = $sala->whereNotIn('id', $ocupadas);

        return view('reservas.search', compact('libres', 'fecha', 'hora', 'numpersonas', 'telefono'));

    }

    public function cancelarReserva($reserva){
        $reserva = Reserva::findOrFail($reserva);

        if ($reserva->user_id != auth()->id()) {
            abort(403);
        }

        $reserva->estado = 'cancelada';
        $reserva->save();

        return redirect()->route('mis-reservas');
    }
}
