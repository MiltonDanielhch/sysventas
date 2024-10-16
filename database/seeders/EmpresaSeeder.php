<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empresa::create([
            'pais' => 'bolivia',
            'nombre_empresa' => 'admin',
            'tipo_empresa' =>'empresa',
            'nit' => '57465634635', // password
            'telefono' => '3543635',
            'correo' => 'admin@admin.com',
            'cantidad_impuesto' => '2',
            'nombre_impuesto' => 'nacional',
            'moneda' => 'boliviano',
            'direccion' => 'c/ flor de patuju',
            'ciudad' => 'trinidad',
            'departamento' => 'Beni',
            'codigo_postal' => 591,
            'logo' => 'logo.png',
        ]);
    }
}
