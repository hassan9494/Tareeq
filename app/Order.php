<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
       'status', 'name','user_id','email','country','phone','age',
       'nationality','gender','readArabic','whatsApp','course',
       'created_at' ,'updated_at', 'knowUs'
    ];

//    public function products()
//    {
//        return $this->belongsToMany(Product::class,'order_products','order_id','product_id')->withPivot('price','product_variation_id','quantity');
//    }
    // public function product()
    // {
    //     return $this->belongsTo(Product::class,'product_id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    // public function teacher()
    // {
    //     return $this->belongsTo(User::class,'teacher_id');
    // }
}
