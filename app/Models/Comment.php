<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];


    ////Model event generate for send mail to user
    // protected static function boot()
    // {
    //     parent::boot();

    //     self::created(function($comment){

    //         //// dd("created");
    //         $subscribers = $comment->post->likes;
    //         //// dd($subscriber[0]->user);

    //         foreach($subscribers as $subscriber)
    //         {
    //             $user = $subscriber->user;

    //             Mail::raw('New Comment On a Post You Liked', function($message) use($user){

    //                 $message->to($user->email,'admin')->subject('New Comment Added');

    //             });
    //         }

    //     });
    // }


    //  1 * foriegn key user_id ,,depends on User
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class );
    }

    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

     // like checks 
     public function likeByCurrentUser()
     {
         return $this->likes()->where('user_id' , auth()->id())->exists();
     }

}

