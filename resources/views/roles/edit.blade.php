@extends('layouts.admin')

@section('title')
    Form for updating roles
@endsection

@section('content')
    <h1 class="text-white">Form for updating roles</h1>

    <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" 
            placeholder="Edit a name" id="name" 
            class="form-control"
            value="{{ old('name', $role->name) }}"
            class="@error('name') is-invalid @enderror"
            >
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection