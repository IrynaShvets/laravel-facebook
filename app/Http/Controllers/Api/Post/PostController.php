<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreApiRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
  private $repository;

  public function __construct(PostRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function allData(Request $request)
  {
    $this->authorize('viewAny', User::class);
    $posts = $this->repository->list();
    return PostResource::collection($posts);
  }

  public function store(StoreApiRequest $request)
  {
    $this->authorize('create', Post::class);
    $validated = $request->validated();
    $validated = $request->safe();
    if ($validated) {
      $post = $this->repository->create([
        'title' => $request->title,
        'description' => $request->description,
        'body' => $request->body,
        'image' => $request->image,
      ]);
    }
    return response()->json([
      'post' => new PostResource($post),
    ]);
  }

  public function show(Post $post)
  {
    $this->authorize('view', Post::class);
    return new PostResource($post);
  }

  public function update(StoreRequest $request, Post $post)
  {
    $this->authorize('update', Post::class);
    if ($request->user()->id !== $post->user_id) {
      return response()->json(['error' => 'You can only update your own posts.'], 403);
    }
    $post->update($request->only(['title', 'description', 'body']));
    return new PostResource($post);
  }

  public function destroy(Post $post)
  {
    $this->authorize('delete', Post::class);
    $post->delete();
    return response()->json(null, 204);
  }
}
