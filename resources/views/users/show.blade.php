@extends('layouts.admin')

@section('title')
    {{$user->name}}
@endsection

@section('content')
    <h1 class="text-white">{{$user->name}}</h1>
    <div class="alert bg-white bg-gradient">
        <img src="{{ $user->avatar_image }}" width="100" height="100"/>
        <h3 class="text-dark">{{$user->name}}</h3>
        <p><small>{{ $user->created_at }}</small></p>
    </div>
@endsection