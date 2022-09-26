<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{

    protected $fillable = ['amount','type','voucher_cat','note','to','user_id','paid_for','account_id'];

//    public function supplier(){
//        return $this->belongsTo(Supplier::class);
//    }
//    public function customer(){
//        return $this->belongsTo(Customer::class);
//    }
//    public function category(){
//         return $this->belongsTo(VoucherCategories::class,'voucher_cat');
//    }
    public function user(){
         return $this->belongsTo(User::class)->withTrashed();
    }
//    public function account(){
//         return $this->belongsTo(Account::class);
//    }
//    public function employee(){
//        return $this->belongsTo(User::class,'employee_id');
//
//    }


}
