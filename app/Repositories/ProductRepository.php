<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

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
        return Product::where('slider', 1)->orderBy('id', 'desc')->get();
    }

    /**
     * @param  array  $products
     * @return mixed
     */
    public static function getSumm(array $products, string $start, string $end): int
    {
        $summ = 0;

        foreach ($products as $product) {
            $summ += Product::find($product)->price;
        }

        $summ *= Carbon::create($start)->diffInDays(Carbon::create($end)) + 1;

        return $summ;
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
//        dd($limit, $page, $search, $category);

        return Product::withRelations()->take($page)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%");
            })->when($category, function ($query) use ($search, $category) {
                $query->where('category_id', $category);
            })->orderBy('id', 'desc')->paginate($limit);
    }

    /**
     * @return mixed
     */
    public static function getUserProducts(): mixed
    {
        return auth()->user()->products();
    }
}
