<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function allData(Request $request)
    {
        // $page = $data['page'] ?? 1;
        // $perPage = $data['per_page'] ?? 10;paginate($perPage, ['*'], 'page', $page)
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        // $post = Post::create([
        //     'user_id' => $request->user()->id,
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'body' => $request->body,
        // ]);
    
        // if ($request->hasFile('image')) {
        //     $destination_path = 'images';
        //     $image = $request->file('image');
        //     $image_name = time()."_".$image->getClientOriginalName();           
        //     $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
        //     $post['image'] = $path;
        // }
        // return new PostResource($post);

        $validator = Validator::make($request->all(), [
          'title' => 'required|min:5|max:255|string',
          'description' => 'required|min:5|max:100|string',
          // 'user_id' => 'required|integer|exists:users,id',
          'body' => 'required|min:5|string',
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      
      // if ($validator->fails()) {
      //     $errors = $validator->errors();
      //     return response()->json([
      //         'error' => $errors
      //     ], 400);
      // }
       $user = Auth::user();

      if ($validator->passes()) {
          $post = Post::create([
              'title' => $request->title,
              'description' => $request->description,
              'body' => $request->body,
              'image' => $request->image,
              'user_id' => $user->id,
          ]);

         
          if ($request->hasFile('image')) {
              $destination_path = 'images';
              $image = $request->file('image');
              $image_name = date('d-m-Y')."_".$image->getClientOriginalName();           
              $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
              $post->image = $path;
              $post->save();
            //   Storage::disk('s3')->put($path, file_get_contents($image));
          }
          
          return response()->json([
              'post' => $post,
          ]);
      }
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
