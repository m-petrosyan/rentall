<?php

namespace App\Interfaces;

interface BrandInterface
{
    public static function getAll();

    public static function getPaginate(int $limit, int $page);
}
