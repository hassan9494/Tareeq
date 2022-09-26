<?php

namespace App;

use App\Models\CourseLesson;
use Illuminate\Database\Eloquent\Model;

class LessonChangesDate extends Model
{
    protected $fillable = ['lesson_id','date','time','comment','status'];

    public function lesson()
    {
        return $this->belongsTo(CourseLesson::class,'lesson_id');
    }
}
