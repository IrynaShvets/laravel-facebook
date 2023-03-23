@extends('layouts.admin')

@section('title')
    Form for updating roles
@endsection

@section('content')
    <h1 class="text-white">Form for updating roles</h1>

    <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
       
        <div class="col-md-4 bg-white">
            @foreach($permissions as $permission)
            <input type="checkbox" class="form-check-input" name="permissions[]" @foreach($role->permissions as $rolePermission) {{ $permission->id === $rolePermission ? 'checked' : '' }} @endforeach
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