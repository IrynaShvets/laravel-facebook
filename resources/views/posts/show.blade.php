@extends('layouts.admin')

@section('title')
    {{$post->name}}
@endsection

@section('content')
    <h1 class="text-white">{{$post->name}}</h1>
    <div class="alert bg-white bg-gradient">
        <img src="{{ asset("$post->image") }}" width="300px" height="auto"/>
        <h5 class="card-title">{{ $post->title }}</h5>
        <h6 class="card-subtitle mb-2">{{ $post->created_at }}</h6>
        <p class="card-text">{{ $post->description }}</p>
        <p class="card-text">{{ $post->body }}</p>
        <p><small>{{ $post->created_at }}</small></p>
    </div>
@endsection