@extends('layouts.app')

@section('title')
    All posts
@endsection

@section('content')
    <h1>All posts</h1>

<div class="d-flex flex-wrap">

    @foreach ($posts as $post)
        <div class="card m-2 bg-primary bg-gradient bg-opacity-50" style="width: 18rem;">
            <div class="card-body">
            <img src="{{ $post->image }}" alt="{{ $post->title }}" width="100%" heigh="100px" class="card-title">
                <h5 class="card-title">{{ $post->title }}</h5>
                <h6 class="card-subtitle mb-2">{{ $post->created_at }}</h6>
                <p class="card-text">{{ $post->description }}</p>
                <p class="card-text">{{ $post->body }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="card-link text-danger">Post link</a>
            </div>
        </div>
    @endforeach

</div>
    
@endsection