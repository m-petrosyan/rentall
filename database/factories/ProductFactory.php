<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'title' => $this->faker->text(20),
            'price' => $this->faker->numberBetween(5000, 50000),
            'description' => $this->faker->realTextBetween(400, 1500),
            'image' => $this->faker->imageUrl(640, 480),
            'slider' => $this->faker->boolean,
        ];
    }
}
