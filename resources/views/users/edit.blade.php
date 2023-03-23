@extends('layouts.admin')

@section('title')
    Form for updating users
@endsection

@section('content')
    <h1 class="text-white">Form for updating users</h1>

    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" 
            placeholder="Edit a name" id="name" 
            class="form-control"
            value="{{ old('name', $user->name) }}"
            class="@error('name') is-invalid @enderror"
            >
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" 
            placeholder="Edit a email" id="email" 
            class="form-control"
            value="{{ old('email', $user->email) }}"
            class="@error('email') is-invalid @enderror"
            >
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" 
            placeholder="Edit a image" 
            id="title" class="form-control"
            value="{{ old('image', $user->image) }}"
            class="@error('image') is-invalid @enderror"
            >
        </div>
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelectCategory">Users</label>
            <select class="form-select" name="role_id" id="inputGroupSelect01">
                <option disabled>Select role...</option>
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