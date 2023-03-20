@extends('layouts.admin')

@section('title')
    All users
@endsection

@section('content')
    <h1 class="text-white">All users</h1>
    <table class="table table-bordered table-hover m-2 bg-white">
    <thead class="">
        <tr>
            <th scope="col">User name</th>
            <th scope="col">Date created user</th>
            <th scope="col">Delete a user</th>
        </tr>
    </thead>

    @foreach ($users as $user)
    <tbody>
        <tr>
            <td>
                <h5 class="card-title">{{ $user->name }}</h5>
            </td>
            <td>
                <h6 class="card-subtitle mb-2">{{ $user->created_at }}</h6>
            </td>
            <td>
                <button data-bs-toggle="modal" class="btn bg-secondary text-white" data-bs-target="#deleteUserModal_{{$user->id}}" data-action="{{ route('users.destroy', $user->id) }}">Delete</button>
            </td>
        </tr>
    </tbody>

        <!-- Delete User Modal -->
        <div class="modal fade" id="deleteUserModal_{{$user->id}}" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteUserModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="modal-body">
                                <h5 class="text-center">Are you sure you want to delete this user?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, delete user</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endforeach

</table>
    
@endsection