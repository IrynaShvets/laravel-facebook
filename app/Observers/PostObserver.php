<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    
    public function creating(Post $post): void
    {
        if(Auth::check()) {
            $post->user_id = Auth::user()->id;
        }
    }

    public function updating(Post $post): void
    {
        if(Auth::check()) {
            $post->user_id = Auth::user()->id;
        }
    }

    public function deleting(Post $post): void
    {
        // Storage::delete('posts/' . $post->image);
    }
}
