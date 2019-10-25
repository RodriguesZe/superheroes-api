<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait Uuids
{
    /**
     * Boot function for the Uuid trait.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = str_replace('-', '', Uuid::generate(4)->string);
        });
    }
}
