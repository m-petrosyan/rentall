<?php

namespace App\Services;

use App\Models\Brand;

class BrandService
{
    /**
     * @param  array  $attributes
     * @return void
     */
    public function store(array $attributes): void
    {
        Brand::create($attributes);
    }

    /**
     * @param  object  $brand
     * @param  array  $attributes
     * @return void
     */
    public function update(object $brand, array $attributes): void
    {
        $brand->update($attributes);
    }

    /**
     * @param  object  $brand
     * @return void
     */
    public function destroy(object $brand): void
    {
        $brand->delete();
    }
}
