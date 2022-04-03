<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 



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
            'tag_id.*' => 'exists:tags,id',
            'thumbnail' => 'image'
        ]);
        $tags_ids = request('tag_id');

        $tags = Tag::find($tags_ids);
        // dd($tags);
        $post = Post::create(request()->except('_token' , 'tag_id'));

        $post->tags()->attach($tags);

        if(request()->hasFile('thumbnail'))
        {
            $ext = request()->file('thumbnail')->getClientOriginalExtension();
            $file_name = $post->id . '.' . $ext;
            request()->file('thumbnail')->move('uploads/posts' , $file_name ); 

            $post->update([
                'thumbnail' => $file_name
            ]);
        }

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
            'tag_id.*' => 'exists:tags,id' ,
            'thumbnail' => 'image'
        ]);

        // if(request()->hasFile('thumbnail'))
        // {
        //     request()->validate([
        //     'thumbnail' => 'image'
        //     ]);
        // }

        $tags_ids = request('tag_id');

        $tags = Tag::find($tags_ids);

        $post->update(request()->except('_token' , 'tag_id'));
        //if new file uploaded again
        if(request()->hasFile('thumbnail'))
        {
            //Previous file delete if user upload new one
            if( File::exists("uploads/posts/$post->thumbnail") )
            {
                File::delete("uploads/posts/$post->thumbnail");
            }
            //new file upload
            $ext = request()->file('thumbnail')->getClientOriginalExtension();
            $file_name = $post->id . '.' . $ext;
            request()->file('thumbnail')->move('uploads/posts' , $file_name ); 

            $post->update([
                'thumbnail' => $file_name
            ]);
        }

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
