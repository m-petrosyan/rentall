<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'product_category_id' => ProductCategory::inRandomOrder()->first()->id,
            'title' => $this->faker->text(20),
            'price' => $this->faker->numberBetween(5000, 50000),
            'description' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(640, 480),
            'slider' => $this->faker->boolean,
        ];
    }
}
