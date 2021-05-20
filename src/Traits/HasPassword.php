<?php

namespace Bastinald\UI\Traits;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait HasPassword
{
    protected static function bootHasPassword()
    {
        static::saving(function ($model) {
            if ($model->password && Str::length($model->password) < 60 && !Str::startsWith($model->password, '$2y$')) {
                $model->password = Hash::make($model->password);
            }
        });
    }
}
