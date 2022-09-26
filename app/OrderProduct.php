<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function order(){
        return $this->belongsTo(Order::Class,'order_id');
    }
    public function product(){
        return $this->belongsTo(Product::Class,'product_id','id');
    }
//    public function provider()
//    {
//        return $this->belongsTo(Provider::class, 'provider_id', 'id');
//    }
}
