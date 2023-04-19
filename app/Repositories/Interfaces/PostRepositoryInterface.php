<?php
namespace App\Repositories\Interfaces;

use App\Http\Filters\PostFilter;

Interface PostRepositoryInterface{
    
    public function list(PostFilter $filters);
    public function create($data);
    public function get($id);
    public function destroy($id);
}