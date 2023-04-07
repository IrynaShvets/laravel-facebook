<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{

    public function list()
    {
        return Post::all()->orderBy('created_at','DESC');
    }

    public function create($data)
    {
        return Post::create($data);
    }

    public function get($id)
    {
        return User::find($id);
    }

    public function update($data, $id)
    {
        $post = Post::where('id', $id)->first();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->body = $data['body'];
        $post->image = $data['image'];
        $post->save();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}