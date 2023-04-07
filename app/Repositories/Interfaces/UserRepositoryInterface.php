<?php
namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
    
    public function list();
    public function get($id);
    public function register($data);
    public function update($data, $id); 
    public function destroy($id);
}
