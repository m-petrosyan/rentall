<?php

namespace App\Interfaces;

interface CategoryInterface
{
    public static function getAll();

    public static function getPaginate(int|null $limit, int|null $page);
}
