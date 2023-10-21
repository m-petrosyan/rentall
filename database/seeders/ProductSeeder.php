<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(50)->create();

        $products = Product::get();

        $faker = Faker::create();
        $imageUrl = $faker->imageUrl(640, 480, null, false);

        foreach ($products as $product) {
            $product->addMediaFromUrl($imageUrl)->toMediaCollection('main_image');
            if ($product->slider) {
                $product->addMediaFromUrl($imageUrl)->toMediaCollection('slider_image');
            }
        }
    }
}
