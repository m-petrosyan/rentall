<?php

namespace Database\Seeders;

use App\Models\Kit;
use App\Models\Product;
use Illuminate\Database\Seeder;

class KitProductPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kit = Kit::all();

// Populate the pivot table
        Product::all()->each(function ($user) use ($kit) {
            $user->kits()->attach(
                $kit->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
