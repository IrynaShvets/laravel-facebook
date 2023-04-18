<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Common;
use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Common::class);
        $commons = Common::orderBy('title','ASC')->paginate(5);
        return view('commons.index', compact('commons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Common::class);
        $commons = Common::all();
        $users = User::get();
        return view('commons.create', compact('commons', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Common::class);
        $data = request()->validate([
            'title' => 'required|min:2|max:50|string',
            'users' => 'required|array',
        ]);
        $users = $data['users'];
        unset($data['users']);
    
        $common = Common::create($data);
        $common->users()->attach($users);
 
        return redirect()->route('commons.index')->with('success', 'The common has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Common $common)
    {
        $this->authorize('view', Common::class);
        $common = $common;
        $commonUsers = $common->users;
    
        return view('commons.show', compact('common', 'commonUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Common::class);
        $common = Common::find($id);
        $users = User::all();
        return view('commons.edit', compact('common', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Common $common)
    {
        $this->authorize('update', Common::class);

        $data = request()->validate([
            'users' => 'sometimes|array',
        ]);
        $users = $data['users'];
        unset($data['users']);
        
        $common->update($data);
        $common->users()->sync($users);
        return back()->with('Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Common::class);
        Common::find($id)->delete();
        return redirect()->route('commons.index')->with('success', '204');
    }
}
