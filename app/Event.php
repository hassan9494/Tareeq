<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use Mediable;
    use HasTranslations;
    public $translatable = ['name','sh_desc','desc'];

    protected $dates=['created_at','start_date','end_date'];

}
