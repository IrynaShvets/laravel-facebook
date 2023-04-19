<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::orderBy('name','ASC')->paginate(5);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        $roles = Role::all();
        $permissions = Permission::get();
        
        return view('roles.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        $data = request()->validate([
            'name' => 'required|unique:roles|max:50',
            'permissions' => 'required|array',
        ]);
        $permissions = $data['permissions'];
        unset($data['permissions']);
    
        $role = Role::create($data);
        $role->permissions()->attach($permissions);
 
        return redirect()->route('roles.index')->with('success', 'The role has been added.');
    }

    public function show(Role $role)
    {
        $this->authorize('view', Role::class);
        $role = $role;
        $rolePermissions = $role->permissions;
    
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function edit(string $id)
    {
        $this->authorize('update', Role::class);
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', Role::class);

        $data = request()->validate([
            'permissions' => 'sometimes|array',
        ]);
        $permissions = $data['permissions'];
        unset($data['permissions']);
        
        $role->update($data);
        $role->permissions()->sync($permissions);
        return back()->with('Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Role::class);
        $role = Role::find($id);

        $role->permissions()->detach($id);
    
        return redirect()->route('roles.index')->with('success', '204');
    }
}
