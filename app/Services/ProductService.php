<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends FileService
{
    /**
     * @param  array  $attributes
     * @return void
     */
    public function store(array $attributes): void
    {
        $kits = $attributes['kits'] ?? null;
        $similars = $attributes['similars'] ?? null;
        $mainImage = $attributes['main_image'];
        $sliderImage = $attributes['slider_image'] ?? null;
        unset($attributes['kits'], $attributes['similars'], $attributes['main_image'], $attributes['slider_image']);

        $product = ProductRepository::getUserProducts()->create($attributes);

        FileService::saveFile($product, $mainImage, 'main_image');
        if ($sliderImage) {
            FileService::saveFile($product, $sliderImage, 'slider_image');
        }

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
        $kits = $attributes['kits'] ?? null;
        $similars = $attributes['similars'] ?? null;
        $mainImage = $attributes['main_image'] ?? null;;
        $sliderImage = $attributes['slider_image'] ?? null;
        unset($attributes['kits'], $attributes['similars'], $attributes['main_image'], $attributes['slider_image']);

        if ($mainImage) {
            $product->getMedia('main_image')->first()?->delete();
            FileService::saveFile($product, $mainImage, 'main_image');
        }
        if ($sliderImage) {
            $product->getMedia('slider_image')->first()?->delete();
            FileService::saveFile($product, $sliderImage, 'slider_image');
        }

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
