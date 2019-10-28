<?php

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public static function apply(Builder $builder, $value): Builder;
}
