<?php

namespace App\Services;

use Illuminate\Support\Str;

class FileService
{
    /**
     * @param  object  $model
     * @param  object  $file
     * @param  string  $name
     * @return void
     */
    public static function saveFile(object $model, object $file, string $name): void
    {
        $model->addMediaFromRequest($name)
            ->usingFileName(time().Str::random(5).'.'.$file->getClientOriginalExtension())
            ->toMediaCollection($name);
    }
}
