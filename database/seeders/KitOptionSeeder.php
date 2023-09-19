<?php

namespace Database\Seeders;

use App\Models\KitOption;
use Illuminate\Database\Seeder;

class KitOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KitOption::factory()->count(20)->create();
    }
}
