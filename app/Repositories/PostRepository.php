<?php

namespace App\Repositories;

use App\Filters\PostFilters;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{

    public function list()
    {
        return Post::all();
    }

    public function create($data)
    {
        return Post::create($data);
    }

    public function get($id)
    {
        return Post::find($id);
    }

    public function update($post, $data)
    {
        $post = Post::where('post', $post)->first();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->body = $data['body'];
        $post->image = $data['image'];
        $post->save();
    }

    public function destroy($post)
    {
        $post = Post::find($post);
        $post->delete();
    }

    public function getFiltered(PostFilters $filters)
    {
        return Post::filter($filters)->get();
    }
}