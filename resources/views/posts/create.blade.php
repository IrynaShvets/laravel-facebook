@extends('layouts.app')

@section('title')
    Posts
@endsection

@section('content')
    <h1>Posts</h1>

    <form action="{{ route('post-form') }}" method="post">
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
            <label for="description">description</label>
            <textarea name="description" id="description" placeholder="Enter a description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="body">body</label>
            <textarea name="body" id="body" placeholder="Enter a body" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Send</button>
    </form>
@endsection