<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * A post belongs to a user
     * Use this method to get the owner of the post
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Use this method to get the category under the post
     */
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function isLiked(){
      return  $this->likes()->where('user_id', auth()->user()->id)->exists();
    }
}
