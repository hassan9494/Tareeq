<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','stock','price','product_id'];
    //
    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
