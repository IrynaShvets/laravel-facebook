<?php
namespace App\Repositories\Interfaces;

use App\Http\Filters\UserFilter;
use Illuminate\Http\Request;

Interface UserRepositoryInterface{
    public function list(UserFilter $filters);
    public function get($id);
    public function register($data);
    public function update($user, $data); 
    public function destroy($user);
    public function addFriend($id);
    public function removeFriend($id);
}
