<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $table = 'category_post'; //this is the table that this model should interact
    protected $fillable = ['post_id', 'category_id']; //these are the columns names of the table
    public $timestamps = false; //set to false because we don't need to use it

    /**
     * Use this method to get the name of the category
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
