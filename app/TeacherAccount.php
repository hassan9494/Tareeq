<?php

namespace App;

use App\Models\CourseLesson;
use Illuminate\Database\Eloquent\Model;

class TeacherAccount extends Model
{
    protected $fillable = ['amount','to','paid_for','user_id','lesson_id','note'];

    public function lesson()
    {
        return $this->belongsTo(CourseLesson::class,'lesson_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
