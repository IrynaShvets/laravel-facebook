@extends('layouts.admin')

@section('title')
    Form for creating posts
@endsection

@section('content')

    <h1 class="text-white">Form for creating posts</h1>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Enter a title" id="title" 
            class="form-control" 
            value="{{ old('title') }}"
            class="@error('title') is-invalid @enderror"
        >
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" 
            name="image" 
            id="image"
            class="form-control"
            value="{{ old('image') }}"
            class="@error('image') is-invalid @enderror"
            >
        </div>
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="description">Description post</label>
            <textarea name="description" 
            id="description" 
            placeholder="Enter a description" 
            class="form-control"
            class="@error('image') is-invalid @enderror"
            >{{ old('description') }}</textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="body">Text post</label>
            <textarea name="body" id="body" 
            placeholder="Enter a text for the post" 
            class="form-control" 
            class="@error('image') is-invalid @enderror">{{ old('body') }}</textarea>
        </div>
        @error('body')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelectCategory">Users</label>
            <select class="form-select" name="user_id" id="inputGroupSelect01">
                <option selected>Select user...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        @error('user_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>

@endsection