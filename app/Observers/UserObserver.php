<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    public function created(User $user): void
    {
        $user->notify(new WelcomeEmailNotification());
    }

    public function deleting(User $user): void
    {
        // Storage::delete('users/' . $user->image);
    }
}
