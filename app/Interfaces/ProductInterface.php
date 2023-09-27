<?php

namespace App\Interfaces;

interface ProductInterface
{
    public static function getAll();

    public static function getWithPaginate(int $limit, int $page);

    public static function getSimilar();

    public static function getUserProducts();
}
