<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Rent;
use App\Models\RentProduct;
use Illuminate\Database\Seeder;

class RentProductPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kit = Rent::all();

        Product::all()->each(function ($product) use ($kit) {
            $product->rents()->attach(
                $kit->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
