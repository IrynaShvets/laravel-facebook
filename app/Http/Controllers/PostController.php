<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\User;
use \App\Http\Requests\Post\StoreRequest;
use \App\Http\Requests\Post\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        
        $path = $request->file('image')->store('public/images');
        $post->image = $path;

        $post->save();
        return redirect()->route('posts.index')->with('success', 'The post has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = new Post();
        return view('posts.show', ['post' => $post->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        $post->image = $request->input('image');

        $post->save();
        return redirect()->route('posts.index')->with('success', 'The post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->delete();
        return redirect()->route('posts.index')->with('success', '204');
    }
}
