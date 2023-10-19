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
        $similars = ($attributes['similars']);
        unset($attributes['kits'], $attributes['similars']);


        $product = ProductRepository::getUserProducts()->create($attributes);

        $product->kits()->attach($kits);
        $product->similars()->attach($similars);
    }

    /**
     * @param  object  $product
     * @param  array  $attributes
     * @return void
     */
    public function update(object $product, array $attributes): void
    {
        $kits = ($attributes['kits']);
        $similars = ($attributes['similars']);
        unset($attributes['kits'], $attributes['similars']);

        $product->update($attributes);
        $product->kits()->sync($kits);
        $product->similars()->sync($similars);
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
