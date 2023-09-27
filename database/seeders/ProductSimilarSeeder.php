<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSimilarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::all();

        foreach ($product as $item) {
            $item->similar()->attach($product->random(rand(6, 12))->pluck('id')->toArray());
        }
    }
}
