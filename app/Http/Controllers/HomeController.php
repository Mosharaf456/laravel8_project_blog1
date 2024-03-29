<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(20);
        
        $categories = Category::all(); 

        return view('home.index' ,[
            'posts' => $posts,
            'categories' => $categories
        ]);

    }
    public function show(Post $post)
    {
        return view('home.show' , [
            'post' => $post
        ]);
    }
}
