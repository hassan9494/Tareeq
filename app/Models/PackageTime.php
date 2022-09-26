<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTime extends Model
{
    protected $fillable = ['time'];

    public function packages(){
        return $this->hasMany(Package::class,'package_time_id');
    }
}
