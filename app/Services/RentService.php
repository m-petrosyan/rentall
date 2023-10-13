<?php

namespace App\Services;

use App\Models\Rent;
use App\Repositories\ProductRepository;

class RentService
{
    /**
     * @param  array  $attributes
     * @return void
     */
    public function store(array $attributes): void
    {
        $products = $attributes['products'];

        $attributes['total_price'] = ProductRepository::getSumm($products);

        unset($attributes['products']);

        $rent = Rent::create($attributes);

        $rent->products()->attach($products);
    }
}
