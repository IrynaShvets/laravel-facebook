<?php

namespace App\Observers;

use App\Models\Post;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    
    public function creating(Post $post): void
    {
        if(Auth::check()) {
            $post->user_id = Auth::user()->id;
        }
    }
    
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    public function updating(Post $post): void
    {
        if(Auth::check()) {
            $post->user_id = Auth::user()->id;
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
