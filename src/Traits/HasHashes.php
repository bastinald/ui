<?php

namespace Bastinald\Ui\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait HasHashes
{
    protected static function bootHasHashes()
    {
        static::saving(function ($model) {
            if (!$model->hashes) {
                return;
            }

            foreach (Arr::wrap($model->hashes) as $hash) {
                if ($model->$hash &&
                    Str::length($model->$hash) < 60 &&
                    !Str::startsWith($model->$hash, '$2y$')) {
                    $model->$hash = Hash::make($model->$hash);
                }
            }
        });
    }
}
