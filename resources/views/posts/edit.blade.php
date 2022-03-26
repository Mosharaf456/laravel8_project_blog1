@extends('layouts.app')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    <form action="/posts/{{$post->id}}/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}" placeholder="Post Title">
                            @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Post Category</label>
                            <select id="category" type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{ $post->title }}" placeholder="Post category">
                                <option>Select a Category</option>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}> {{ $category->name }} </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            
                            <label for="tag_id">Post Tags </label>

                            <select id="tag_id" type="text" class="form-control @error('tag_id') is-invalid @enderror"
                                name="tag_id[]" placeholder="Post Tag" multiple>

                                <option>Select tags</option>
                                @foreach ($tags as $tag)
                                  <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                @endforeach
                            </select>

                            @error('tag_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input id="thumbnail" type="file" name="thumbnail"  class="form-control @error('thumbnail') is-invalid @enderror" 
                             placeholder="thumbnail" >

                            @error('thumbnail')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                             @enderror
                             <img src='{{ asset("uploads/posts/$post->thumbnail") }}' alt="Thumbnail" width="100">
                        </div>

                        <div class="form-group">
                           <label for="body">Body</label>
                           <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" placeholder="Body" rows="7">
                            {{ $post->body }}</textarea>
                           @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                       </div>
                       <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>   

<script>

    $(function() {
        $("#tag_id").select2();
    });

</script>


@endsection
