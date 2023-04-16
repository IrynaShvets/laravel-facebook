<?php

namespace App\Http\Controllers\Api\Post;


use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\StoreApiRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class PostController extends Controller
{
  /**
   * @var repository
   */
  private $repository;

  /**
   * UserController constructor.
   *
   * @param repository $repository
   */
  public function __construct(PostRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Display a listing of the resource.
   * @param FilterRequest $request
   * @return PostResource
   * 
   */
  public function list(FilterRequest $request): AnonymousResourceCollection
  {
    $posts = $this->repository->list($request->validated());
    return PostResource::collection($posts);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param StoreApiRequest $request
   * @return PostResource
   * @throws AuthorizationException
   */
  public function store(StoreApiRequest $request): PostResource
  {
    $this->authorize('create', Post::class);
    $post = $this->repository->create($request->validated());
    return new PostResource($post);
  }

  /**
   * Display the specified resource.
   *
   * @param Post $post
   * @return PostResource
   * @throws AuthorizationException
   */
  public function show(string $id): PostResource
  {
    $this->authorize('view', Post::class);
    $post = $this->repository->get($id);
    return new PostResource($post);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param StoreApiRequest $request
   * @param Post $post
   * @return PostResource
   * @throws AuthorizationException
   */
  public function update(StoreApiRequest $request, Post $post): PostResource
  {
    $this->authorize('update', $post);
    $updated = $this->repository->update($post, $request->validated());
    return new PostResource($updated);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Post $post
   * @return Response
   * @throws AuthorizationException
   */
  public function delete(string $id): Response
  {
    $this->authorize('delete', Post::class);
    $this->repository->destroy($id);
    return response()->noContent();
  }
}
