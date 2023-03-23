@extends('layouts.admin')

@section('title')
    Form for creating roles
@endsection

@section('content')

    <h1 class="text-white">Form for creating roles</h1>

    <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" placeholder="Enter a name" id="name" 
            class="form-control" 
            value="{{ old('name') }}"
            class="@error('name') is-invalid @enderror"
        >
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="col-md-4 bg-white">
            @foreach($permissions as $permission)
            <input type="checkbox" class="block"
                name="permissions[]" {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }} class="form-check-input" 
                value="{{ $permission->id }}" id="{{ $permission->id }}">
                {{ $permission->name }}
                <br/>
            @endforeach
        </div>
        @error('permissions')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>

@endsection