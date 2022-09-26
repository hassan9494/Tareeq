<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    protected $fillable = ['days','classes','Months6','Months12','class_price','total_price','package_time_id'];

    public function packageTime(){
        return $this->belongsTo(PackageTime::class,'package_time_id');
    }
}
