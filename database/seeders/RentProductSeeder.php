<?php

namespace Database\Seeders;

use App\Models\RentProduct;
use Illuminate\Database\Seeder;

class RentProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RentProduct::factory()->count(20)->create();
    }
}
