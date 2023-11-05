<?php

namespace App\Services;

use App\Models\Kit;
use Illuminate\Support\Arr;

class KitService
{
    /**
     * @param  array  $attributes
     * @return void
     */
    public function store(array $attributes): void
    {
        Kit::create(Arr::only($attributes, ['title']))->options()->attach($attributes['options']);
    }


    /**
     * @param  object  $kit
     * @param  array  $attributes
     * @return void
     */
    public function update(object $kit, array $attributes): void
    {
        $kit->update(Arr::only($attributes, ['title']));
        $kit->options()->sync($attributes['options']);
    }

    /**
     * @param  object  $kit
     * @return void
     */
    public function destroy(object $kit): void
    {
        $kit->delete();
    }
}
