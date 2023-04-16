<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    public const TITLE = 'title';
   

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
           
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