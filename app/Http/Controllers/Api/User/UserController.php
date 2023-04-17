<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\FilterRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\UpdateMyselfRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function index(FilterRequest $request): AnonymousResourceCollection
    {
        $users = $this->repository->list($request->validated());
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
    public function update(UpdateMyselfRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $updated = $this->repository->update($user, $request->validated());
        return new UserResource($updated);

        // $user = $request->user();
        // $validatedData = $request-> validated();
        // $user->update($validatedData);
        // $user = $user->refresh();
        // $success['user'] = $user;
        // $success['success'] = true;
        // return response()->json($success, 200);
    }

//     public function update(Request $request)
//   {
//     $user = Auth::user();

//     $user->name = $request->input('name');
//     $user->email = $request->input('email');
//     $user->password = bcrypt($request->input('password'));

//     $user->save();

//     return response()->json(['success' => true]);
//   }


    public function addFriend($id)
    {
        $friends = $this->repository->addFriend($id);
        return UserResource::collection($friends);
    }

    public function removeFriend($id)
    {
        $friends = $this->repository->removeFriend($id);
        return UserResource::collection($friends);
    }

}
