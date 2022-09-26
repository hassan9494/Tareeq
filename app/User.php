<?php

namespace App;

use App\Models\TeacherAppointment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Plank\Mediable\Mediable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Mediable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','phone','country','facebook','whatsApp','qualifications','gender','age','academic_year','timezone'
        ,'course_days','teacher_id','course_start_date','course_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getVideoAttribute($value)
    {
        $video = str_replace('watch?v=', 'embed/', $value);
        return $video;

    }
    public function teachCourses()
    {
        return $this->belongsToMany(Product::class, 'teacher_courses','user_id','product_id');
    }
    public function teacherAppointment()
    {
        return $this->hasOne(TeacherAppointment::class,'user_id');
    }
    public function teacher()
    {
        return $this->belongsTo(self::class,'teacher_id');
    }
    public function course()
    {
        return $this->belongsTo(Product::class,'course_id');
    }

    public function teacherAccounts (){
        return $this->hasMany(TeacherAccount::class,'user_id');
    }
}
