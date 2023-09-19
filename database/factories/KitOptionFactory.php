<?php

namespace Database\Factories;

use App\Models\Kit;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\KitOption>
 */
class KitOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kit_id' => Kit::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
        ];
    }
}
