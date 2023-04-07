<?php
namespace App\Repositories\Interfaces;

Interface PostRepositoryInterface{
    
    public function list();
    public function create($data);
    public function get($id);
    public function update($data, $id); 
    public function destroy($id);
}