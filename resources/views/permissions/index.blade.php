@extends('layouts.admin')

@section('title')
    All permissions
@endsection

@section('content')
<h1 class="text-white">All permissions</h1>
<table class="table table-bordered table-hover m-2 bg-white">
    <thead class="">
        <tr>
            <th scope="col">Permission name</th>
            <th scope="col">Permission description</th>
            <th scope="col">Delete permission</th>
        </tr>
    </thead>

    @foreach ($permissions as $permission)

    <tbody>
        <tr>
            <td>
                <h5>{{ $permission->name }}</h5>
            </td>
            <td>
                <h5>{{ $permission->description }}</h5>
            </td>
            <td>
                <button data-bs-toggle="modal" class="btn bg-secondary text-white" data-bs-target="#deletePermissionModal_{{$permission->id}}" data-action="{{ route('permissions.destroy', $permission->id) }}">Delete</button>
            </td>
        </tr>
    </tbody>

    <!-- Delete Permission Modal -->
    <div class="modal fade" id="deletePermissionModal_{{$permission->id}}" data-backdrop="static" tabindex="-1" permission="dialog" aria-labelledby="deletePermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" permission="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePermissionModalLabel">This action is irreversible.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('permissions.destroy', $permission->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        
                        <input id="id" name="$permission->id" hidden value="">
                        <h5 class="text-center">Are you sure you want to delete this permission?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, delete post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</table>

@endsection