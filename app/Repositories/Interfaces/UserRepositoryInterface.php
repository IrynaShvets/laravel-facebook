<?php
namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
    public function list();
    public function get($id);
    public function register($data);
    public function update($user, $data); 
    public function destroy($user);
}
