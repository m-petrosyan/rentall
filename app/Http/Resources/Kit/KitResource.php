<?php

namespace App\Http\Resources\Kit;

use App\Http\Resources\KitOption\KitOptionCollection;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KitResource extends JsonResource
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
            'options' => new KitOptionCollection($this->options),
        ];

        if (!request()->routeIs('product.*')) {
            $data['user'] = new UserResource($this->user);
        }

        return $data;
    }
}
