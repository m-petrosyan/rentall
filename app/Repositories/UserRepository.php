<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserInterface
{
    /**
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return User::all();
    }

    /**
     * @return Authenticatable
     */
    public static function getLoggedInUser(): Authenticatable
    {
        return auth()->user();
    }

}
