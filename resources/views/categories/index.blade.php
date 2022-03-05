@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show all Categories</div>

                <div class="card-body">

                    @include('partials.success_message')

                    <table class="table table-striped">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>
                                    <a href="/categories/{{$category->id}}/edit" class="btn btn-warning btn-sm">Edit</a> |
                                    <a href="/categories/{{$category->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
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
