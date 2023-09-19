<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            KitSeeder::class,
            KitOptionSeeder::class,
            RentSeeder::class,
            RentProductSeeder::class,
            KitProductPivotSeeder::class,
        ]);
    }
}
