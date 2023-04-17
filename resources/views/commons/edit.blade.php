@extends('layouts.admin')

@section('title')
Form for updating commons
@endsection

@section('content')
<h1 class="text-white">Form for updating commons</h1>

<form class="" action="{{ route('commons.update', ['common' => $common->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input value="{{ $common->title }}" type="text" class="form-control" name="title" placeholder="Title" required>
    </div>

    <div>
        <label for="users" class="block mb-2 text-sm font-medium text-gray-900">
            Select users
        </label>
        <select id="users" name="users[]" style="width: 100%; height: 200px; background-color: white;"  class="mh-100 bg-gray-600 border border-gray-300 text-gray-900 rounded-lg block w-full p-3" multiple>
            @foreach ($users as $user)
            <option class="mb-2" value="{{ $user->id }}" @selected($common->users->contains($user->id))
                @class([
                'bg-purple-600 text-dark' => $common->users->contains($user->id)
                ])>
                {{ $user->name }}
            </option>
            @endforeach
        </select>
    </div>
    @error('users')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-success">Submit</button>
</form>
@endsection