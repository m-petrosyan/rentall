<?php

namespace App\Interfaces;

interface ProductInterface
{
    public static function getAll();

    public static function getWithPaginate(int $limit, int $page, string|null $search, int|null $category);

    public static function getSliders();

    public static function getSumm(int $products);

    public static function getUserProducts();
}
