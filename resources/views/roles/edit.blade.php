@extends('layouts.admin')

@section('title')
Form for updating roles
@endsection

@section('content')
<h1 class="text-white">Form for updating roles</h1>

<form class="" action="{{ route('roles.update', ['role' => $role->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input value="{{ $role->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
    </div>

    <div>
        <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900">
            Select permissions
        </label>
        <select id="permissions" name="permissions[]" style="width: 100%; height: 200px; background-color: white;"  class="mh-100 bg-gray-600 border border-gray-300 text-gray-900 rounded-lg block w-full p-3" multiple>
            @foreach ($permissions as $permission)
            <option class="mb-2" value="{{ $permission->id }}" @selected($role->permissions->contains($permission->id))
                @class([
                'bg-purple-600 text-dark' => $role->permissions->contains($permission->id)
                ])>
                {{ $permission->name }}
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