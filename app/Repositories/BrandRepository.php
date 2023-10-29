<?php

namespace App\Repositories;

use App\Interfaces\BrandInterface;
use App\Models\Brand;
use Illuminate\Contracts\Pagination\Paginator;
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

    public static function getPaginate(int $limit, int $page): Paginator
    {
        return Brand::orderBy('id', 'desc')->take($page)->paginate($limit);
    }
}
