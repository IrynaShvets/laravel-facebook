@extends('layouts.admin')

@section('title')
    Form for creating commons
@endsection

@section('content')

    <h1 class="text-white">Form for creating commons</h1>

    <form action="{{ route('commons.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
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

        <div class="col-md-4 bg-white">
            @foreach($users as $user)
            <input type="checkbox" class="block"
                name="users[]" {{ in_array($user->id, old('users', [])) ? 'checked' : '' }} class="form-check-input" 
                value="{{ $user->id }}" id="{{ $user->id }}">
                {{ $user->name }}
                <br/>
            @endforeach
        </div>
        @error('users')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>

@endsection