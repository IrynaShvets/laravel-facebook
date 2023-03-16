@extends('layouts.app')

@section('title')
    All users
@endsection

@section('content')
    <h1>All users</h1>

<div class="d-flex flex-wrap">

    @foreach ($users as $user)
        <div class="card m-2 bg-primary bg-gradient bg-opacity-50" style="width: 18rem;">
            <div class="card-body">
            <img src="{{ $user->image }}" alt="{{ $user->name }}" width="100%" heigh="100px" class="card-title">
                <h5 class="card-title">{{ $user->name }}</h5>
                <h6 class="card-subtitle mb-2">{{ $user->created_at }}</h6>
                <p class="card-text">{{ $user->email }}</p>
                <a href="{{ route('users.show', $user->id) }}"><button class="btn btn-success">User link</button></a>
                <a href="{{route('users.edit', $user->id)}}"><button class="btn btn-warning">Edit</button></a>
                <a href="{{route('users.destroy', $user->id)}}"><button class="btn btn-danger">Delete</button></a>
            </div>
        </div>
    @endforeach

</div>
    
@endsection