<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

use \App\Http\Requests\User\StoreRequest;
use \App\Http\Requests\User\UpdateRequest;
use App\Models\Permission;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.create', ['roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->image = $request->input('image');
        $user->permission_id = $request->input('permission_id');
        $user->role_id = $request->input('role_id');
     
        $user->save();
        return redirect()->route('users.index')->with('success', 'The user has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = new User();
        return view('users.show', ['user' => $user->find($id)]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', '204');
    }
}
