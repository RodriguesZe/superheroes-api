<?php

namespace App\Services\Search\Filters;

use App\Services\Search\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class Publisher implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param  Builder  $builder
     * @param  mixed  $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        if($value === null || $value === '')
        {
            return $builder;
        }

        return $builder->where('publisher', 'like', '%' . $value . '%');
    }
}
