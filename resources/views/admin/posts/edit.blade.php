@extends('layouts.app')

@section('title')
    Form for updating posts
@endsection

@section('content')
    <h1>Form for updating posts</h1>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{$post->title}}" placeholder="Edit a title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" value="{{$post->image}}" placeholder="Edit a image" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description post</label>
            <textarea name="description" id="description" placeholder="Edit a description" class="form-control">{{$post->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="body">Text post</label>
            <textarea name="body" id="body" placeholder="Edit a text for the post" class="form-control">{{$post->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection