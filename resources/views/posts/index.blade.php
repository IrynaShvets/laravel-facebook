@extends('layouts.admin')

@section('title')
All posts
@endsection

@section('content')
<h1 class="text-white">All posts</h1>

<table class="table table-bordered text-white table-hover m-2 bg-secondary">
    <thead class="">
        <tr>
            <th scope="col">Post name</th>
            <th scope="col">Date created post</th>
            <th scope="col">Access buttons</th>
        </tr>
    </thead>

    @foreach ($posts as $post)

    <tbody>
        <tr>
            <td>
                <h5>{{ $post->title }}</h5>
            </td>
            <td>
                <h6>{{ $post->created_at }}</h6>
            </td>
            <td>
                <a href="{{ route('posts.show', $post->id) }}"><button class="btn btn-success">Show post</button></a>
            </td>
            <td>
                <a href="{{route('posts.edit', $post->id)}}"><button class="btn btn-warning">Edit</button></a>
            </td>
            <td>
                <button data-bs-toggle="modal" class="btn btn-danger" data-bs-target="#deletePostModal_{{$post->id}}" data-action="{{ route('posts.destroy', $post->id) }}">Delete
                </button>
            </td>
        </tr>
    </tbody>
    <!-- Delete Post Modal -->
    <div class="modal fade" id="deletePostModal_{{$post->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePostModalLabel">This action is irreversible.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('posts.destroy', $post->id) }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="$post->id" hidden value="">
                        <h5 class="text-center">Are you sure you want to delete this post?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, delete post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endforeach
</table>

<div class="mt-3">
    {{ $posts->withQueryString()->links() }}
</div>
@endsection