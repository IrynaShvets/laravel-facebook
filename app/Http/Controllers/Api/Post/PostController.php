<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{

    public function allData(Request $request)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        $posts = Post::paginate($perPage, ['*'], 'page', $page);
        return PostResource::collection($posts);
    }

    public function submit(StoreRequest $request)
    {
        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        
        if ($request->hasFile('image')) {
            $destination_path = 'images';
            $image = $request->file('image');
            $image_name = time()."_".$image->getClientOriginalName();           
            $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
            $post->image = $path;
        }

        $post->save();
        return new PostResource($post);
    }

}
