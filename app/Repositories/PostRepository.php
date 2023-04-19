<?php

namespace App\Repositories;

use App\Http\Filters\PostFilter;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostRepositoryInterface
{

    public function list($data) 
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
  
        $filters = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        // $f = Post::filter($filters)->paginate($perPage, ['*'], 'page', $page);
        // dd($filters);
        return Post::filter($filters)->paginate($perPage, ['*'], 'page', $page);
    }

    public function create($data)
    {
        return Post::create($data);
    }

    public function get($id)
    {
        return Post::find($id);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
    }
}