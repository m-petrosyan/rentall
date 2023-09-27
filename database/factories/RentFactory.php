<?php

namespace Database\Factories;

use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'tel' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'comment' => $this->faker->text(200),
            'total_price' => $this->faker->randomFloat(0, 5000, 50000),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}
