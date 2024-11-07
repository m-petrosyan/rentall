<?php

namespace App\Repositories;

use App\Interfaces\RentInterface;
use App\Models\Rent;
use Illuminate\Database\Eloquent\Collection;

class RentRepository implements RentInterface
{
    /**
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return Rent::orderByDesc('id')->withRelations();
    }
}
