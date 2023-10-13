<?php

namespace App\Services;

class SimilarService
{
    /**
     * @param  object  $product
     * @param  array  $products
     * @return void
     */
    public function store(object $product, array $products): void
    {
        $product->similar()->attach($products);
    }

    public function update(object $product, array $products): void
    {
        $product->similar()->sync($products);
    }
}
