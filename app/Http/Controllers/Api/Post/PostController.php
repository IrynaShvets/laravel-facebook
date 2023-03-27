<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{

    public function allData(Request $request)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        $posts = Post::paginate($perPage, ['*'], 'page', $page);
        return PostResource::collection($posts);
    }

}
