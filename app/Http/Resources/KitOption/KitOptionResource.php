<?php

namespace App\Http\Resources\KitOption;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KitOptionResource extends JsonResource
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
            'price' => $this->price,
        ];
    }
}
