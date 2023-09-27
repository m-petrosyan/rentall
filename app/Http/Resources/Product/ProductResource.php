<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Kit\KitCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'slider' => $this->slider,
            'brand' => new CategoryResource($this->brand),
            'category' => new CategoryResource($this->category),
        ];

        if (!request()->routeIs('kit.*')) {
            $data['kits'] = new KitCollection($this->kits()->withRelations());
        }

        if (request()->routeIs('product.show')) {
            $data['similar_products'] = new ProductSimilarCollection($this->similar()->randomItem());
        }

        return $data;
    }
}
