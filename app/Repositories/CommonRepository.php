<?php

namespace App\Repositories;

use App\Http\Requests\Common\CommonRequest;
use App\Models\Common;
use App\Models\User;
use App\Repositories\Interfaces\CommonRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function get($id)
    {
        return Common::find($id);
    }

    public function addMyself($id)
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $user->commons()->syncWithoutDetaching($id);

            return $user->commons;
        }
    }
    
}