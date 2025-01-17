<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique->ean13(),
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'imagen' => $this->faker->imageUrl(640, 480, 'products', true),
            'stock' => $this->faker->numberBetween(10, 100),
            'stock_minimo' => $this->faker->numberBetween(5, 10),
            'stock_maximo' => $this->faker->numberBetween(50, 200),
            'precio_compra' => $this->faker->randomFloat(2,10,500),
            'precio_venta' => $this->faker->randomFloat(2,20,600),
            'fecha_ingreso' => $this->faker->date(),
            'categoria_id' => 1,
            'empresa_id' => 1,
        ];
    }
}
