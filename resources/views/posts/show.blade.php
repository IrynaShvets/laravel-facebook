@extends('layouts.app')

@section('title')
    {{$data->name}}
@endsection

@section('content')

<h1>{{$data->name}}</h1>
<div class="alert bg-info bg-gradient">
    <p>{{ $data->title }}</p>
    <p><small>{{ $data->created_at }}</small></p>
    
</div>
@endsection