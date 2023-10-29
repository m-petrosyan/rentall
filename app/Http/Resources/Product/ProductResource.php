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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'main_image' => $this->getFirstMediaUrl('main_image'),
            'slider_image' => $this->getFirstMediaUrl('slider_image'),
            'slider' => $this->slider,
            'brand' => new CategoryResource($this->brand),
            'category' => new CategoryResource($this->category),
            'kits' => new KitCollection($this->kits()->withRelations()->get()),
            'similars' => new ProductSimilarCollection($this->similars()->randomItem()),
        ];
    }
}
