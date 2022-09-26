<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use Mediable;
    use HasTranslations;
    public $translatable = ['subject','sh_desc','desc'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function categoryBlog(){
        return $this->belongsTo(BlogCategory::class,'post_cat_id');
    }
}
