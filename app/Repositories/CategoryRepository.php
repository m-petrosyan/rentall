<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
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
}
