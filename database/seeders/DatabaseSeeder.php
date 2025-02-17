<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $administrador = Role::create(['name'=>'ADMINISTRADOR']);

        // // $this->call([EmpresaSeeder::class]);
        // $this->call([UserSeeder::class]);

        Producto::factory()->count(50)->create();
    }
}
