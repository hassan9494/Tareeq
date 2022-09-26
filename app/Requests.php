<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        'service_id','page_id','name','email','phone','typeOfBusiness','note','views'
    ];
    public function service()
    {
        return $this->belongsTo(Post::class,'service_id');
    }
    public function page()
    {
        return $this->belongsTo(Page::class,'page_id');
    }
}
