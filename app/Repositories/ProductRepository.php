<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductInterface
{
    /**
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return Product::withRelations();
    }


    /**
     * @param  int  $limit
     * @param  int  $page
     * @return mixed
     */
    public static function getWithPaginate(int $limit, int $page): mixed
    {
        return Product::withRelations()->take($page)->paginate($limit);
    }

    /**
     * @return mixed
     */
    public static function getSimilar(): mixed
    {
        return Product::inRandomOrder()->limit(6)->get();
    }

    /**
     * @return mixed
     */
    public static function getUserProducts(): mixed
    {
        return auth()->user()->products();
    }
}
