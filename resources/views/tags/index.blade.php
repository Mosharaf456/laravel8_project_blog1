@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show all tags</div>

                <div class="card-body">

                    @include('partials.success_message')

                    <table class="table table-striped">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td>{{$tag->name}}</td>
                                <td>{{$tag->description}}</td>
                                <td>
                                    <a href="/tags/{{$tag->id}}/edit" class="btn btn-warning btn-sm">Edit</a> |
                                    <a href="/tags/{{$tag->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
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
