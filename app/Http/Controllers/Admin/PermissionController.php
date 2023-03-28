<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Permission::class);
        $permissions = Permission::orderBy('name','ASC')->paginate(5);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Permission::class);
        $permission = Permission::all();
        return view('permissions.create', ['permission' => $permission]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Permission::class);

        $data = request()->validate([
            'name' => 'required|string|unique:roles|max:50',
            'description' => 'nullable|string|max:100',
        ]);
    
        Permission::create($data);
        return redirect()->route('permissions.index')->with('success', 'The role has been added.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Permission::class);
        Permission::find($id)->delete();
        return redirect()->route('permissions.index')->with('success', '204');
    }
}
