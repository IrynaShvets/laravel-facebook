<?php
namespace App\Repositories\Interfaces;

use App\Filters\PostFilters;

Interface PostRepositoryInterface{
    
    public function list(PostFilters $filters);
    public function create($data);
    public function get($id);
    public function update($post, $data); 
    public function destroy($post);
    // public function getFiltered(PostFilters $filters);
}