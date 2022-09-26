<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    //
    protected $fillable = ['key','values','product_id'];
    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
