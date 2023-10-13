<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    /**
     * @param  array  $attributes
     * @return void
     */
    public function store(array $attributes): void
    {
        $kits = ($attributes['kits']);
        unset($attributes['kits']);

        ProductRepository::getUserProducts()->create($attributes)->kits()->attach($kits);
    }

    /**
     * @param  object  $product
     * @param  array  $attributes
     * @return void
     */
    public function update(object $product, array $attributes): void
    {
        $kits = ($attributes['kits']);
        unset($attributes['kits']);

        $product->update($attributes);
        $product->kits()->sync($kits);
    }

    /**
     * @param  object  $product
     * @return void
     */
    public function destroy(object $product): void
    {
        $product->delete();
    }
}
