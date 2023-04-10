<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    protected $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function apply()
    {
        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return array_filter($this->request->only($this->filterable));
    }
}
