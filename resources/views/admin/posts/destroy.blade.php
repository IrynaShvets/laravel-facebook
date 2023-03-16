@extends('layouts.app')

@section('title')
    Form for deleting posts
@endsection

@section('content')
    <h1>Form for deleting posts</h1>

    <form method="POST" action="{{route('admin.posts.destroy', $post->id}}" enctype="multipart/form-data">  
        @csrf
        {{ method_field('delete')}}
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Yes, I am</button>
        </div>
    </form>
@endsection