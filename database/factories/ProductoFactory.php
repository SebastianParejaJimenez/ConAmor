<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;
use App\Models\User;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        $precios = [1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 15000, 20000, 25000, 30000, 35000, 40000, 45000, 50000];

        return [
            'nombre' => $this->faker->word,
            'tipo' => $this->faker->word,
            'precio' => $this->faker->randomElement($precios),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },            
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

