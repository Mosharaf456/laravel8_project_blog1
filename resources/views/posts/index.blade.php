@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts List</div>

                <div class="card-body">

                    @include('partials.success_message')

                    <table class="table table-striped">
                        <tr>
                            <th>#ID</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Posted By</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->created_at->diffForHumans()}}</td>
                                <td>Lingkon</td>
                                <td>
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-warning btn-sm">Edit</a> |
                                    <a href="/posts/{{$post->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
