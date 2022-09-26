<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherCategories extends Model
{
    protected $fillable = ['name'];
    public function vouchers(){
        return $this->hasMany(Voucher::class);
    }
}
