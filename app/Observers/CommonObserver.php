<?php

namespace App\Observers;

use App\Models\Common;
use Illuminate\Support\Facades\Auth;

class CommonObserver
{
    public function creating(Common $common): void
    {
        if(Auth::check()) {
            $common->user_id = Auth::user()->id;
        }
    }
    
    /**
     * Handle the Common "created" event.
     */
    public function created(Common $common): void
    {
        //
    }

    /**
     * Handle the Common "updated" event.
     */
    public function updated(Common $common): void
    {
        //
    }

    /**
     * Handle the Common "deleted" event.
     */
    public function deleted(Common $common): void
    {
        //
    }

    /**
     * Handle the Common "restored" event.
     */
    public function restored(Common $common): void
    {
        //
    }

    /**
     * Handle the Common "force deleted" event.
     */
    public function forceDeleted(Common $common): void
    {
        //
    }
}
