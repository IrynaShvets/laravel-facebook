@extends('layouts.app')

@section('title')
    Form for creating posts
@endsection

@section('content')
    <h1>Form for creating posts</h1>

    <form action="{{ route('admin.posts.create') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Enter a title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" name="image" placeholder="Enter a image" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description post</label>
            <textarea name="description" id="description" placeholder="Enter a description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="body">Text post</label>
            <textarea name="body" id="body" placeholder="Enter a text for the post" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection