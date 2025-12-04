<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salas')->insert(['capacidad' => 10, 'equipamiento' => 'proyector', 'tipo' => 'interior']);
        DB::table('salas')->insert(['capacidad' => 8, 'equipamiento' => 'pizarra', 'tipo' => 'terraza']);
        DB::table('salas')->insert(['capacidad' => 6, 'equipamiento' => 'proyector', 'tipo' => 'barra']);
        DB::table('salas')->insert(['capacidad' => 5, 'equipamiento' => 'wifi', 'tipo' => 'privada']);
        DB::table('salas')->insert(['capacidad' => 5, 'equipamiento' => 'proyector', 'tipo' => 'interior']);
        DB::table('salas')->insert(['capacidad' => 10, 'equipamiento' => 'proyector', 'tipo' => 'terraza']);
        DB::table('salas')->insert(['capacidad' => 2, 'equipamiento' => 'wifi', 'tipo' => 'privada']);
        DB::table('salas')->insert(['capacidad' => 3, 'equipamiento' => 'pizarra', 'tipo' => 'interior']);
    }
}
