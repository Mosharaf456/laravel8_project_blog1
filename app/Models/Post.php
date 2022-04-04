<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    //* *
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    //1 *
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    public function likes()
    {
        return $this->morphMany('App\Models\Like' , 'likeable');
    }

    //common path declare for files upload
    public function thumbnail_path()
    {
        return asset("uploads/posts/$this->thumbnail");
    }

    // like checks 
    public function likeByCurrentUser()
    {
        return $this->likes()->where('user_id' , auth()->id())->exists();
    }
}
