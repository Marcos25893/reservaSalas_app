<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalaResource;
use App\Models\Reserva;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

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
                        ->where('capacidad', '<=', (2 + $numpersonas))->get();

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
        $reservas = Reserva::findOrFail($reserva);

        //Mejor hacerlo con policies
        //Si la reserva no es del usuario sale error
        if (!auth()->user()->admin) {
            if ($reservas->user_id != auth()->id()) {
                abort(403);
            }
        }

        $reservas->estado = 'cancelada';
        $reservas->save();

        if (auth()->user()->admin){
            return redirect()->route('reservas.pendientes');
        }else {
            return redirect()->route('mis-reservas');
        }
    }

    public function pendientes(){
        $reservas = Reserva::where('fecha', '>=', now()->toDateString())->get();

        return view('reservas.pendientes', compact('reservas'));
    }

    public function filtrar(Request $request){
        $fecha = $request->input('fecha');
        $estado = $request->input('estado');

        if ($estado == 'todas') {
            $estados = ['pendiente', 'cancelada', 'confirmada'];
            $reservas = Reserva::where('fecha', '=', $fecha)->
            whereIn('estado', $estados)->get();
        }else{
            $reservas = Reserva::where('fecha', '=', $fecha)->
            where('estado', '=', $estado)->get();
        }

        return view('reservas.pendientes', compact('reservas'));
    }

    public function confirmarReserva($reserva){
        $reservas = Reserva::findOrFail($reserva);

        //Mejor hacerlo con policies
        //Si la reserva no es del usuario sale error
        if (!auth()->user()->admin) {
            abort(403);
        }

        if ($reservas->estado == 'pendiente'){
            $reservas->estado = 'confirmada';
            $reservas->save();
        }

        return redirect()->route('reservas.pendientes');
    }



    ////////////////////////////API///////////////////
    public function apiNewReserva(Request $request){
        $sala_id=$request->input('sala_id');
        $telefono=$request->input('telefono');
        $fecha=$request->input('fecha');
        $hora=$request->input('hora');
        $numpersonas=$request->input('numpersonas');
        $user_id=auth()->user()->id;

        //Comprobar disponibilidad
        $reservaOcupada = DB::table('reservas')->where('sala_id', $sala_id)
            ->where('fecha', $fecha)
            ->where('hora', $hora)
            ->first();

        if ($reservaOcupada){
            return response()->json([
                "mensaje" => "Ya existe una reserva en esta sala",
                "error" => 1
            ]);
        }

        //sala es demasiado grande
        $sala = Sala::findOrFail($sala_id);
        if (($sala->capacidad < $numpersonas) || (($sala->capacidad - $numpersonas) > 2)){
            return response()->json([
                "mensaje" => "Sala de tamaño incompatible",
                "error" => 2
            ]);
        }

        $reserva = Reserva::create([
            'sala_id' => $sala_id,
            'telefono' => $telefono,
            'fecha' => $fecha,
            'hora' => $hora,
            'numpersonas' => $numpersonas,
            'estado' => 'pendiente',
            'user_id' => $user_id
        ]);

        return $reserva->toResource();
    }

    public function apiUpdateReserva($id){
        $reservas = Reserva::findOrFail($id);

        if (!auth()->user()->admin){
            if ($reservas->user_id !=auth()->user()->id){
                abort(403);
            }
        }

        $reservas->estado = 'cancelada';
        $reservas->save();

        return $reservas->toResource();
    }

    public function apiDeleteReserva($id){
        $reservas = Reserva::findOrFail($id);

        //Comprobar que la reserva sea mia o del admin
        if (!auth()->user()->admin) {
            if ($reservas->user_id != auth()->user()->id) {
                abort(403);
            }
        }

        $reservas->delete();

        return response()->json([
            "mensaje" => "Reserva eliminada",
            "reserva" => $reservas->toResource()
        ]);
    }

    public function apiGetSalas(){
        return SalaResource::collection(Sala::all());
    }

    public function GetSalaById(string $id){
        return new SalaResource(Sala::findorFail($id));
    }

    public function GetReservasAdmin (){
        //Tienes que ser admin
        if (auth()->user()->admin) {
            return Reserva::all()->toResourceCollection();
        } else
            abort(401);
    }

    public  function GetReservasUser(){
        //Solo muestra tus reservas
        return Reserva::where('user_id', '=', auth()->id())->get()->toResourceCollection();
    }


    public function getReservasById(string $id){/***///
        //Muestra una sola reserva por id
        $reserva = Reserva::findorFail($id);

        if ($reserva->user_id == auth()->id()) {
            return $reserva->toResource();
        } else
            abort(403);
    }
}
