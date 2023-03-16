<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Http\Requests\Post\StoreRequest;
use \App\Http\Requests\Post\UpdateRequest;

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
        return view('posts.create');
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
        $post->image = $request->input('image');

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
        $post = new Post;
        return view('posts.edit', ['post' => $post->find($id)]);
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
