<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use Mediable;
    use HasTranslations;
    public $translatable = ['title','desc'];

}
