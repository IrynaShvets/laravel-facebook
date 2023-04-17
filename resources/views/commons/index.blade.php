@extends('layouts.admin')

@section('title')
    All commons
@endsection

@section('content')
<h1 class="text-white">All commons</h1>
<table class="table table-bordered table-hover m-2 bg-white">
    <thead class="">
        <tr>
            <th scope="col">Common title</th>
            <th scope="col">Access buttons</th>
        </tr>
    </thead>

    @foreach ($commons as $common)

    <tbody>
        <tr>
            <td>
                <h5>{{ $common->title }}</h5>
            </td>
            <td>
                <a href="{{ route('commons.show', $common->id) }}"><button class="btn btn-success">Show common</button></a>
            </td>
            @can('update', $common)
            <td>
                <a href="{{route('commons.edit', $common->id)}}"><button class="btn btn-warning">Edit</button></a>
            </td>
            @endcan
            @can('delete', $common)
            <td>
                <button data-bs-toggle="modal" class="btn bg-secondary text-white" data-bs-target="#deleteCommonModal_{{$common->id}}" data-action="{{ route('commons.destroy', $common->id) }}">Delete</button>
            </td>
            @endcan
        </tr>
    </tbody>

    <!-- Delete Common Modal -->
    <div class="modal fade" id="deleteCommonModal_{{$common->id}}" data-backdrop="static" tabindex="-1" common="dialog" aria-labelledby="deleteCommonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCommonModalLabel">This action is irreversible.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('commons.destroy', $common->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input id="id" name="$common->id" hidden value="">
                        <h5 class="text-center">Are you sure you want to delete this common?</h5>
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

<div class="mt-3">
    {{ $commons->withQueryString()->links() }}
</div>

@endsection