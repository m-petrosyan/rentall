<?php

namespace App\Repositories;

use App\Interfaces\KitInterface;
use App\Models\Kit;
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
}
