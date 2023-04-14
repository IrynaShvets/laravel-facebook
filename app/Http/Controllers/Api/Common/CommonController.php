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
// dd(new CommonResource($common));

    return CommonResource::collection($common);
  }

  public function create(CommonRequest $request)
  {
    $common = $this->repository->create($request->validated());
    return new CommonResource($common);
  }
}
