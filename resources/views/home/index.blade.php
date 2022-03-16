@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts Lists</div>

                <div class="card-body">
                    @foreach ($posts as $post)
                        <h3>{{ $post->title }}</h3>
                    @endforeach
                    
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Categories Lists</div>

                <div class="card-body">
                    @foreach ($categories as $category)
                         <h3>{{ $category->name }}</h3>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
