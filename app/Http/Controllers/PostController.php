<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\User;
use \App\Http\Requests\Post\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Post::class, 'post');
    // }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        
        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('view', auth()->user());
        // $this->authorize('create', Post::class);
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        
        // if ($request->user()->cannot('create', Post::class)) {
        //     abort(403);
        // }
        $post = new Post;
        
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        
        if ($request->hasFile('image')) {
            $destination_path = 'images';
            $image = $request->file('image');
            $image_name = time()."_".$image->getClientOriginalName();           
            $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
            $post->image = $path;
        }
        
        $post->save();
        return redirect()->route('posts.index')->with('success', 'The post has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post, 'users' => $users, ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        
        $post = Post::find($id);

        // if ($request->user()->cannot('update', $post)) {
        //     abort(403);
        // }
        $this->authorize('update', $post);

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->user_id = $request->input('user_id');
        
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($post->is_image);
            $destination_path = 'images';
            $image = $request->file('image');
            $image_name = time()."_".$image->getClientOriginalName();           
            $path = $request->file('image')->storeAs($destination_path , $image_name, 'public');
            $post->image = $path;
        }

        $post->save();
        return redirect()->route('posts.index')->with('success', 'The post has been added.');
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
