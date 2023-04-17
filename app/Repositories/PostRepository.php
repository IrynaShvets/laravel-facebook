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

    // public function update($post, $data)
    // {
    //     $post = Post::where('post', $post)->first();
    //     $post->title = $data['title'];
    //     $post->description = $data['description'];
    //     $post->body = $data['body'];
    //     $post->image = $data['image'];
    //     $post->save();
    // }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
    }
}