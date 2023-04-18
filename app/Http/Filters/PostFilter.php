<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const SORTER = 'sorter';
   

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::SORTER => [$this, 'sorter'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function sorter(Builder $builder, $value)
    {   
        $builder->orderBy('created_at', $value);
    }
    
}