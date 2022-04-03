<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    //  1 * foriegn key user_id ,,depends on User
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

