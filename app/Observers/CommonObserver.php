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
}