<?php

namespace App\Models;

use App\LessonChangesDate;
use App\TeacherAccount;
use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    protected $fillable = ['course_id','date','time','day','status'];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function lessonChangeDate (){
        return $this->hasMany(LessonChangesDate::class,'lesson_id')->orderBy('date');
    }

    public function teacherAccount (){
        return $this->hasOne(TeacherAccount::class,'lesson_id');
    }
}
