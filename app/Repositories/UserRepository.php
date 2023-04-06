<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function index()
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        return User::latest()->orderBy('created_at','DESC')->paginate($perPage, ['*'], 'page', $page);
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update($data, $id)
    {
        
        $user = User::where('id', $id)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->image = $data['image'];
        $user->save();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}