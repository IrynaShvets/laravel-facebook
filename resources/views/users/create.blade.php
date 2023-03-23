@extends('layouts.admin')

@section('title')
    Form for creating users
@endsection

@section('content')

    <h1 class="text-white">Form for creating users</h1>

    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Enter a name" id="name" 
            class="form-control" 
            value="{{ old('name') }}"
            class="@error('name') is-invalid @enderror"
        >
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Enter a email" id="email" 
            class="form-control" 
            value="{{ old('email') }}"
            class="@error('email') is-invalid @enderror"
        >
        </div>
        @error('email')
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
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter a password" id="password" 
            class="form-control" 
            value="{{ old('password') }}"
            class="@error('password') is-invalid @enderror"
        >
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="password-confirm">Password confirm</label>
            <input type="password" 
            name="password_confirmation"
            placeholder="Enter a confirm password"
            id="password-confirm"
            class="form-control"
            value="{{ old('password_confirmation') }}"
            class="@error('password_confirmation') is-invalid @enderror"
            >
        </div>
        @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelectRole">Roles</label>
            <select class="form-select" name="role_id" id="inputGroupSelectRole">
                <option selected>Select role...</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        @error('role_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>

@endsection