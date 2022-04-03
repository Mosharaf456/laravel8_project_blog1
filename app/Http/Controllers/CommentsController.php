<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
        // checking data
        // dd( request()->all() );

        // validate form data
        request()->validate([ 'body' => 'required|min:3|max:180' ]);

        $post->comments()->create([
            'body' => request('body'),
            'user_id' => 1
            // 'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Comment Added Successfully');
    }
    public function storeLike(Post $post)
    {
        $like = $post->likes()->where('user_id',1)->first();
        if($like)
        {
            $like->delete();
            return back()->with('success', 'You  Disliked This Post.');
        }
        $post->likes()->create([
            'user_id' => 1
        ]);

        return back()->with('success', 'You Liked This Post.');
    }
}
