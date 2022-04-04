@extends('layouts.app')

@section('content')
<div class="container">

    @include('partials.success_message')

    <div class="row justify-content-center">
        <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-header">
                        @if ($post->thumbnail)
                             <img src="{{$post->thumbnail_path()}}" class="rounded" 
                             style=" float:left; margin-right:15px; " alt="Thumbnail" width="200">
                        @endif
                        <a href="posts/{{$post->id}}" style="text-decoration:none; "> <h3>{{ $post->title }}</h3> </a> 
                    </div>

                    <div class="card-body">
                         <p>{{ $post->body }}</p>
                    </div>

                    <div class="card-footer">
                            {{$post->likes->count()}} People Liked this post
                            <a href="/posts/{{$post->id}}/liked" class="btn btn-sm {{($post->likeByCurrentUser()) ?"btn-danger" : "btn-success" }}"> 
                                {{ ($post->likeByCurrentUser()) ? "Dislike" : "Like" }}
                            </a>
                    </div>

                </div>

                <h5>Comments</h5>
                <hr>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="/posts/{{$post->id}}/comments" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="body">Comment</label>
                                <textarea id="body"  
                                    class="form-control @error('body') is-invalid @enderror" 
                                    name="body" 
                                    placeholder="Express your opinion about the post.">
                                </textarea>
                                @error('body')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                 @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                

            @foreach ($post->comments as $comment)
                <div class="card mb-2">
                    <div class="card-header"> {{ $comment->owner->name }} said</div>
                    <div class="card-body">
                        {{ $comment->body }}
                    </div>
                </div>
            @endforeach
                
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Categories Lists</div>

                <div class="card-body">
                   
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
