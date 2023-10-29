<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
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
     * @return mixed
     */
    public static function getSliders(): Collection
    {
        return Product::where('slider', 1)->get();
    }

    /**
     * @param  array  $products
     * @return mixed
     */
    public static function getSumm(array $products): mixed
    {
        return Product::whereIn('id', $products)->sum('price');
    }

    /**
     * @param  int  $limit
     * @param  int  $page
     * @param  string|null  $search
     * @param  int|null  $category
     * @return Paginator
     */
    public static function getWithPaginate(int $limit, int $page, string|null $search, int|null $category): Paginator
    {
        return Product::withRelations()->take($page)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%");
            })->when($category, function ($query) use ($search, $category) {
                $query->where('category_id', $category);
            })->orderBy('id', 'asc')->paginate($limit);
    }

    /**
     * @return mixed
     */
    public static function getUserProducts(): mixed
    {
        return auth()->user()->products();
    }
}
