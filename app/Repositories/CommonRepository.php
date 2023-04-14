<?php

namespace App\Repositories;

use App\Http\Requests\Common\CommonRequest;
use App\Models\Common;
use App\Repositories\Interfaces\CommonRepositoryInterface;
use Illuminate\Http\Request;

class CommonRepository implements CommonRepositoryInterface
{
    public function list()
    {
       return Common::all();
    }
    
    public function create($data)
    {
        return Common::create($data);
    }
}