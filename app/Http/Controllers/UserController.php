<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\Role;
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
        $permissions = Permission::all();
        
        return view('users.create', ['roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    $data = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'password' => 'required|string|min:8|confirmed',
        'role_id' => 'string',
        'permissions' => '',
    ]);

    if ($request->hasFile('image')) {
            $destination_path = 'images';
            $image = $request->file('image');
            $image_name = time()."_".$image->getClientOriginalName();           
            $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
            $data['image'] = $path;
        }

    $permissions = $data['permissions'];
    $data['password'] = Hash::make($data['password']);
    unset($data['permissions']);

    $user = User::create($data);
    
    foreach ($permissions as $permission) {
        PermissionUser::firstOrCreate([
            'permission_id' => $permission,
            'user_id' => $user->id,
        ]);
    }

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
    public function edit(string $id)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $user = User::find($id);
        
        // $selectedPermissions = $user->permissions()->get(['id']);'selectedPermissions' => $selectedPermissions
// dd($selectedPermissions);
        return view('users.edit', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions, ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
            'permissions' => '',
        ]);

        // dd($data);
    
        if ($request->hasFile('image')) {
                $destination_path = 'images';
                $image = $request->file('image');
                $image_name = time()."_".$image->getClientOriginalName();           
                $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
                $data['image'] = $path;
            }
    
        $permissions = $data['permissions'];
        
        unset($data['permissions']);
    
        $user = User::create($data);
        
        foreach ($permissions as $permission) {
            PermissionUser::updateOrCreate([
                'permission_id' => $permission,
                'user_id' => $user->id,
            ]);
        }
    
        return redirect()->route('users.index')->with('success', 'The post has been added.');
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
