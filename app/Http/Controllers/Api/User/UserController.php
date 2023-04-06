<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateMyselfRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users =  $this->userRepository->index();
        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->show($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMyselfRequest $request, string $id)
    {
        $user = $this->userRepository->update($request->all(), $id);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userRepository->destroy($id);
        return response()->json(null, 204);
    }
}
