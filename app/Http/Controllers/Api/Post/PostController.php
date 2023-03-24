<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

use App\Http\Resources\Post\PostResource;


class PostController extends Controller
{

    public function allData(Request $request)
    {
        //$this->authorize('view', auth()->user()); ban on entering the site
        $data = $request->validated();

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $posts = Post::paginate($perPage, ['*'], 'page', $page);

        return PostResource::collection($posts);

    }

}
