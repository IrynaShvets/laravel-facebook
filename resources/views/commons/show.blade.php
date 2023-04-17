@extends('layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>{{ ucfirst($common->title) }} Common</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">

            <h3>Assigned users</h3>

            <table class="table table-striped">
                <thead>
                    <th scope="col">Name</th>
                </thead>

                @foreach($commonUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('commons.edit', $common->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('commons.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection