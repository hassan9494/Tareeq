<?php

namespace App\Models;

use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ["student_id","teacher_id","product_id","start_from","weeks","session_time","application",'free'];

    public function lessons (){
        return $this->hasMany(CourseLesson::class,'course_id')->orderBy('date');
    }
    public function student (){
        return $this->belongsTo(User::class,'student_id')->withTrashed();
    }
    public function teacher (){
        return $this->belongsTo(User::class,'teacher_id')->withTrashed();
    }
    public function product (){
        return $this->belongsTo(Product::class,'product_id')->withTrashed();
    }
}
