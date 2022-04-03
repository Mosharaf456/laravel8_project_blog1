@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-header">
                        @if ($post->thumbnail)
                             <img src="{{$post->thumbnail_path()}}" class="rounded-circle" 
                             style=" float:left; margin-right:15px; " alt="Thumbnail" width="60">
                        @endif
                        <a href="posts/{{$post->id}}" style="text-decoration:none; "> <h3>{{ $post->title }}</h3> </a> 
                    </div>
                    <div class="card-body">
                         <p>{{ $post->body }}</p>
                    </div>
                </div>
            @endforeach

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
