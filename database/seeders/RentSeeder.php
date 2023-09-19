<?php

namespace Database\Seeders;

use App\Models\Rent;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rent::factory()->count(20)->create();
    }
}
