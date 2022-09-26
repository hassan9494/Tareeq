<?php

namespace App;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'user_tasks','user_id','task_id')->withPivot('status','show');
    }
    public function orders(){
        return $this->hasMany(Order::class,'referred_by');
    }
    public function categories()
    {
        return $this->belongsToMany(CategoryProduct::class, 'user_categories','user_id','category_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

}
