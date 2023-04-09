<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function list()
    {
        return User::all();
    }

    public function get($id)
    {
        return User::find($id);
    }

    public function register($data)
    {
        return User::create($data);
    }

    public function update($user, $data)
    {
        $user = User::where('user', $user)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->image = $data['image'];
        $user->save();
    }

    public function destroy($user)
    {
        $user = User::find($user);
        $user->delete();
    }
}