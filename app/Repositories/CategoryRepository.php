<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryInterface
{
    /**
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return Category::all();
    }

    public static function getPaginate(int|null $limit, int|null $page): Paginator
    {
        return Category::orderBy('id', 'desc')->take($page)->paginate($limit);
    }
}
