<?php

namespace App\Repositories;

use App\Interfaces\KitInterface;
use App\Models\Kit;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class KitRepository implements KitInterface
{
    /**
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return Kit::withRelations();
    }

    public static function getPaginate(int $limit, int $page): Paginator
    {
        return Kit::orderBy('id', 'desc')->with('options')->take($page)->paginate($limit);
    }
}
