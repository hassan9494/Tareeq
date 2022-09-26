<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

class Team extends Model
{
    use Mediable;
    use HasTranslations;
    public $translatable = ['name','desc'];

}
