<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable=['name' ,'phone' ,'address' ,'email' ,'employee_name' ,'employee_phone' ,'employee_title' ,'employee_email'];

    public function products(){
        return $this->hasMany(Product::class,'provider_id');
    }
}
