<?php

namespace App\Models\Traits;

// use App\Http\Filters\FilterInterface;

use App\Http\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * @param Builder $builder
 * @param FilterInterface $filter
 * 
 * @return Builder
 */
trait Filterable
{
    public function scopeFilter(Builder $builder, FilterInterface $filter)
    {
        $filter->apply($builder);

        return $builder;
    }
}
