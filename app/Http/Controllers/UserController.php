<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Http\Request;
use \App\Models\User;

use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {

        $validated = $request->validated();
       
        if ($request->hasFile('image')) {
            $destination_path = 'images';
            $image = $request->file('image');
            $image_name = time()."_".$image->getClientOriginalName();           
            $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
            $data['image'] = $path;
        }
        
        User::create($data);

    return redirect()->route('users.index')->with('success', 'The post has been added.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // $permissions = Permission::all();
        $roles = Role::all();
        
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::query()->findOrFail($id);
        $user->update($request->only('role_id'));
        return back()->with('Success');
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
