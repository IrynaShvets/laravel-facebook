<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Models\Post;
use \App\Models\User;
use \App\Http\Requests\Post\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        
        $users = User::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index', compact('posts', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        
        $this->authorize('create', Post::class);

        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        
        $post->save();
        return redirect()->route('posts.index')->with('success', 'The post has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('view', Post::class);
        $post = Post::find($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Post::class);

        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post, 'users' => $users, ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $this->authorize('update', Post::class);
        
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');

        $post->save();
        return redirect()->route('posts.index')->with('success', 'The post has been added.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Post::class);
        
        $post = Post::find($id);
        $post->delete();
        Storage::delete($post->image);

        return redirect()->route('posts.index')->with('success', '204');
    }
}
