<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\CommonRequest;
use App\Http\Resources\Common\CommonResource;
use App\Repositories\Interfaces\CommonRepositoryInterface;

class CommonController extends Controller
{
  /**
   * @var repository
   */
  private $repository;

  /**
   * CommunityController constructor.
   *
   * @param repository $repository
   */
  public function __construct(CommonRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function list()
  {
    $common = $this->repository->list();

    return CommonResource::collection($common);
  }

  public function create(CommonRequest $request)
  {
    $common = $this->repository->create($request->validated());
    return new CommonResource($common);
  }

  public function show(string $id)
    {
        $this->authorize('view', User::class);
        $common = $this->repository->get($id);
        return new CommonResource($common);
    }

  public function addMyself($id)
  {
    $users = $this->repository->addMyself($id);
    return CommonResource::collection($users);
  }

  public function delete(string $id)
  {
    $commons = $this->repository->destroy($id);
    return CommonResource::collection($commons);
  }
}
