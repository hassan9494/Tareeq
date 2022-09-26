<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

class BlogCategory extends Model
{
    use Mediable;
    use HasTranslations;
    public $translatable = ['name','desc'];


    public function posts(){
        return $this->hasMany(Post::class,'post_cat_id');
    }
    protected $dates=['created_at'];



}
