<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use Mediable;
    use HasTranslations;
    public $translatable = ['name'];
}
