<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'deadLine',
        'description',
    ];
    public function users()
    {
        return $this->belongsToMany(Admin::class,'user_tasks','task_id','user_id')->withPivot('status','show');
    }
    protected $dates=['deadLine'];
}
