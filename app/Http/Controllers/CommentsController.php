<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
        // checking data
        // dd( request()->all() );

        // validate form data
        request()->validate([ 'body' => 'required|min:3|max:180' ]);

       $comment = $post->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

////// Mail send to user __procedural way
        $subscribers = $comment->post->likes;
        // dd($subscriber[0]->user);

        foreach($subscribers as $subscriber)
        {
            $user = $subscriber->user;

            Mail::raw('New Comment On a Post You Liked', function($message) use($user){

                $message->to($user->email,'admin')->subject('New Comment Added');

            });
         }

        return back()->with('success', 'Comment Added Successfully');
    }
    public function storeLike(Post $post)
    {
        $like = $post->likes()->where('user_id',auth()->id())->first();
        if($like)
        {
            $like->delete();
            return back()->with('success', 'You  Disliked This Post.');
        }
        $post->likes()->create([
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'You Liked This Post.');
    }
}
