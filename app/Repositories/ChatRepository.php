<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\Interfaces\ChatRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ChatRepository implements ChatRepositoryInterface
{
    public function list($user_id)
    {
        return Message::where(function($query) use($user_id)  {
            $query->where('sender_id', '=', Auth::user()->id);
            $query->where('receiver_id', '=', $user_id);
        })->orWhere(function($query) use($user_id)  {
            $query->where('receiver_id', '=', Auth::user()->id);
            $query->where('sender_id', '=', $user_id);
        })->orderBy('created_at', 'ASC')->get();
    }

    public function send($data) {
        $message = new Message;
        $message->fill($data)->save();
        return $message;
    }
}