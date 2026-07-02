<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['nombre_servicio' => 'Mantenimiento', 'estado' => 'ACTIVO'],
            ['nombre_servicio' => 'Fabricación', 'estado' => 'ACTIVO'],
            ['nombre_servicio' => 'Montaje', 'estado' => 'ACTIVO'],
            ['nombre_servicio' => 'Soldadura', 'estado' => 'ACTIVO'],
            ['nombre_servicio' => 'Corte y Plegado', 'estado' => 'ACTIVO'],
            ['nombre_servicio' => 'Asesoría Técnica', 'estado' => 'ACTIVO'],
        ];

        foreach ($tipos as $tipo) {
            Servicio::firstOrCreate(
                ['nombre_servicio' => $tipo['nombre_servicio']],
                $tipo
            );
        }

        $this->command->info('Tipos de servicio creados correctamente.');
    }
}
