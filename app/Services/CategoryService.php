<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * @param  array  $attributes
     * @return void
     */
    public function store(array $attributes): void
    {
        Category::create($attributes);
    }

    /**
     * @param  object  $category
     * @param  array  $attributes
     * @return void
     */
    public function update(object $category, array $attributes): void
    {
        $category->update($attributes);
    }

    /**
     * @param  object  $category
     * @return void
     */
    public function destroy(object $category): void
    {
        $category->delete();
    }
}
