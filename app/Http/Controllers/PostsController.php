<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = Post::paginate(10);

        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.create' , [
            'categories' => $categories,
            'tags' => $tags
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = request()->validate([
            'title' =>'required|min:5|max:300' ,
            'body' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'tag_id.*' => 'exists:tags,id'
        ]);
        $tags_ids = request('tag_id');

        $tags = Tag::find($tags_ids);
        // dd($tags);
        $post = Post::create(request()->except('_token' , 'tag_id'));

        $post->tags()->attach($tags);

        return redirect('/posts')->with('success','Post Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit',[
            'categories' => $categories,
            'post' => $post,
            'tags'=> $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        $validate_data = request()->validate([
            'title' =>'required|min:5|max:300' ,
            'body' => 'required|min:10',
            'category_id' => 'required|exists:categories,id',
            'tag_id.*' => 'exists:tags,id'
        ]);

        $tags_ids = request('tag_id');

        $tags = Tag::find($tags_ids);

        $post->update(request()->except('_token' , 'tag_id'));

        $post->tags()->sync($tags);

        return redirect('/posts')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
