<?php
namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
    
    public function index();
    public function show($id);
    public function update($data, $id); 
    public function destroy($id);
}
