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
            value="{{ old('image', $user->is_image) }}"
            class="@error('image') is-invalid @enderror"
            >
        </div>
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" 
            placeholder="Edit a password" id="password" 
            class="form-control"
            value="{{ old('password', $user->password) }}"
            class="@error('password') is-invalid @enderror"
            >
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="password-confirm">Password confirm</label>
            <input type="password" name="password_confirmation" 
            placeholder="Edit a password confirmation" id="password-confirm" 
            class="form-control"
            value="{{ old('password_confirmation', $user->password_confirmation) }}"
            class="@error('password_confirmation') is-invalid @enderror"
            >
        </div>
        @error('password_confirmation')
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

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelectPermissions">Permissions</label>
            <select class="form-select" multiple name="permissions[]" id="inputGroupSelectPermissions">
                <option disabled>Select permissions...</option>
                @foreach($permissions as $permission)
                    <option
                    
                    value="{{ $permission->id }}">{{ $permission->name }}
                    </option>
                @endforeach

            </select>
        </div>
        @error('permissions')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection