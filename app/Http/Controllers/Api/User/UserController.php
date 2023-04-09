<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\UpdateMyselfRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', User::class);
        $users =  $this->repository->list();
        return UserResource::collection($users);
    }

    /**
    * Display the specified resource.
    *
    * @param User $user
    * @return UserResource
    * @throws AuthorizationException
    */
    public function show(string $id): UserResource
    {
        $this->authorize('view', User::class);
        $user = $this->repository->get($id);
        return new UserResource($user);
    }
    
    /**
  * Update the specified resource in storage.
  *
  * @param UpdateMyselfRequest $request
  * @param User $user
  * @return UserResource
  * @throws AuthorizationException
  */
    public function update(UpdateMyselfRequest $request, User $user):UserResource
    {
        $this->authorize('update', $user);
        $updated = $this->repository->update($user, $request->validated());
        return new UserResource($updated);
    }

    /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return Response
   * @throws AuthorizationException
   */
    public function destroy(User $user): Response
    {
        $this->authorize('delete', $user);
        $this->repository->destroy($user);
        return response()->noContent();
    }
}
