<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $table = "task_comments";
    protected $fillable=['user_id','user_task_id','comment'];
    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
