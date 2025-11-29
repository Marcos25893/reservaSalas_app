<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservas')->insert(['telefono' => '659856325', 'fecha'=> '2025-11-20', 'hora' => '9:00', 'sala_id' => 1,
            'user_id' => 1, 'numpersonas'=> 8, 'estado'=> 'pendiente', 'created_at'=> now(), 'updated_at'=> now()]);

        DB::table('reservas')->insert(['telefono' => '654555265', 'fecha'=> '2025-11-25', 'hora' => '10:00', 'sala_id' => 2,
            'user_id' => 2, 'numpersonas'=> 6, 'estado'=> 'confirmada', 'created_at'=> now(), 'updated_at'=> now()]);
    }
}

