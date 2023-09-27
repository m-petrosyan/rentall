<?php

namespace App\Repositories;

use App\Interfaces\BrandInterface;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandRepository implements BrandInterface
{
    /**
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return Brand::all();
    }
}
