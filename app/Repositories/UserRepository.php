<?php

namespace App\Repositories;

use App\Http\Filters\UserFilter;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function list($data)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        $filters = app()->make(UserFilter::class, ['queryParams' => array_filter($data)]);
        
        return User::filter($filters)->paginate($perPage, ['*'], 'page', $page);
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