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

    public function store(StoreRequest $request)
    {
        $post = Post::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
        ]);
    
        if ($request->hasFile('image')) {
            $destination_path = 'images';
            $image = $request->file('image');
            $image_name = time()."_".$image->getClientOriginalName();           
            $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
            $post['image'] = $path;
        }
        return new PostResource($post);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(StoreRequest $request, Post $post)
    {
      if ($request->user()->id !== $post->user_id) {
        return response()->json(['error' => 'You can only update your own posts.'], 403);
      }
      $post->update($request->only(['title', 'description', 'body']));
      return new PostResource($post);
    }

    public function destroy(Post $post)
    {
      $post->delete();
      return response()->json(null, 204);
    }
}
