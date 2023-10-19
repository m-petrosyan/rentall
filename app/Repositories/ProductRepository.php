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
        return Product::get();
    }

    /**
     * @param $products
     * @return mixed
     */
    public static function getSumm($products)
    {
        return Product::whereIn('id', $products)->sum('price');
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
    public static function getUserProducts(): mixed
    {
        return auth()->user()->products();
    }
}
