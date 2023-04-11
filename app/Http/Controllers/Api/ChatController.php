<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageRequest;
use App\Http\Resources\UserResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // auth()->check();

        // return view('chat');

        if (Auth::check()) {
            return new UserResource(Auth::user());
        } else {
            return response()->json(['error' => 'Unauthenticated.'], 404);
        }
    }

    public function messages()
    {
        $messages = Message::query()
            ->with('user')
            ->get();

        return response()->json([
            'messages' => $messages,
        ]);
        // return Message::query()
        //     ->with('user')
        //     ->get();
    }

    public function send(MessageRequest $request)
    {
        $message = $request->user()
            ->messages()
            ->create($request->validated());

        broadcast(new MessageSent($request->user(), $message));

        return response()->json([
            'message' => $message,
        ]);
        // return $message;
    }
}
// створення ресурсів, тут зупинилася