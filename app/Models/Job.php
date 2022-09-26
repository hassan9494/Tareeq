<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Job extends Model
{
    use Mediable;
    protected $fillable = ['name','email','phone','job_field','view'];
}
