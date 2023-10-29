<?php

namespace App\Interfaces;

interface KitInterface
{
    public static function getAll();

    public static function getPaginate(int $limit, int $page);
}
