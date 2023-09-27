<?php

namespace App\Http\Resources\Rent;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentResource extends JsonResource
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
            'tel' => $this->tel,
            'email' => $this->email,
            'comment' => $this->comment,
            'total_price' => $this->products()->sum('price'),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'products' => new ProductCollection($this->products->load(['brand', 'category'])),
        ];
    }
}
