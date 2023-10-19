<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Brand\BrandCollection;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Kit\KitCollection;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\KitRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => new ProductResource($this),
            'kits' => new KitCollection(KitRepository::getAll()),
            'similars' => new ProductNameCollection(ProductRepository::getAll()),
            'categories' => new CategoryCollection(CategoryRepository::getAll()),
            'brands' => new BrandCollection(BrandRepository::getAll()),
        ];
    }
}
