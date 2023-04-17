<?php
namespace App\Repositories\Interfaces;

use App\Http\Filters\UserFilter;

Interface UserRepositoryInterface{
    public function list(UserFilter $filters);
    public function get($id);
    public function register($data);
    // public function update($user, $data); 
    public function addFriend($id);
    public function removeFriend($id);
}
