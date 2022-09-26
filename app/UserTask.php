<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    //
    protected $table = "user_tasks";

    public function comments(){
        return $this->hasMany(TaskComment::class,'user_task_id');
    }
}
