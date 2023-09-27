<?php

namespace App\Interfaces;

interface UserInterface
{
    public static function getAll();

    public static function getLoggedInUser();
}
