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
                    <input value="{{ $role->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>
                </div>
       
        <label for="permissions" class="form-label">Assign Permissions</label>

                <table class="table table-striped text-white">
                    <thead>
                        <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                        <th scope="col" width="20%">Name</th>
                        <th scope="col" width="1%">Guard</th> 
                    </thead>

                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" 
                                name="permissions[{{ $permission->id }}]"
                                value="{{ $permission->id }}" 
                                @foreach($role->permissions as $rolePermission) {{ $permission->id === $rolePermission ? 'checked' : '' }} @endforeach>
                            </td>
                            <td class="text-white">{{ $permission->name }}</td>
                            <td class="text-white">{{ $permission->description }}</td>
                        </tr>
                    @endforeach
                </table>

        @error('permissions')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection