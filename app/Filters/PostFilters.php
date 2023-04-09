<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilters
{
    public function title($value)
    {
        return function (Builder $query) use ($value) {
            $query->where('title', 'like', '%' . $value . '%');
        };
    }

    public function user($value)
    {
        return function (Builder $query) use ($value) {
            $query->whereHas('user', function ($q) use ($value) {
                $q->where('name', 'like', '%' . $value . '%');
            });
        };
    }
}