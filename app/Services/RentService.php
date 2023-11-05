<?php

namespace App\Services;

use App\Mail\ContactMessage;
use App\Mail\OrderEmailNotification;
use App\Models\Rent;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Mail;

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

        Mail::to(config('mail')['from']['address'])->send(new OrderEmailNotification($rent->with('products')->first()));
    }
}
