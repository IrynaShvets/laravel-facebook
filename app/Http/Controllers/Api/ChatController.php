<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Repositories\Interfaces\ChatRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
  /**
   * @var repository
  */
  private $repository;

  /**
   * UserController constructor.
   *
   * @param repository $repository
   */
  public function __construct(ChatRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }
    
  public function index($user_id)
  {
    $messages = $this->repository->list($user_id);
    return ChatResource::collection($messages);
  }

  public function send(MessageRequest $request)
  {
    $message = $this->repository->send($request->validated());
    //репозиторій виклик, який повертає модельь повідомлення те що отримала броткащу
    broadcast(new MessageSent($message));
    // повертаю ресурс  через new
    return new ChatResource($message);
  }
}