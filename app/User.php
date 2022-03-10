<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

use Auth;
use Mail;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        Mail::send('email.forgot-password', ['token' => $token ], function ($m) {
            $m->to($this->email, $this->name." ".$this->surname)->subject(trans('email.obj-forgot-pwd'));
        });
    }

    public function getCreatedAtAttribute()
    {
        $timezone = !is_null(Auth::User()) ? Auth::User()->timezone : 'Europe/Rome';
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->tz($timezone);
    }
    public function getUpdatedAtAttribute()
    {
        $timezone = !is_null(Auth::User()) ? Auth::User()->timezone : 'Europe/Rome';
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->tz($timezone);
    }

    public function images()
    {
        return $this->morphMany('App\Lib\Image', 'ref')->orderBy('ordering');
    }


    public function isSuperAdmin(){
        return $this->role == 'superadmin';
    }
    public function isAdmin(){
        return $this->role == 'admin';
    }
    public function isUser(){
        return $this->role == 'user';
    }

    public function getImg($full = "thumb-"){

        if($full == "full") $full = "";

        $image = $this->images()->first();
        if($image){
            $img = $image->filename;
            return config('paths.users_img').$this->id."/".$full.$img;
        }
        
        $img = $this->gender == "M" ? "man.png" : "woman.png";
        return 'img/'.$img;
    }

    public function getRole()
    {
        $color = "";
        $role = ucfirst($this->role);
        if($role == "Superadmin")
            $color = "dark";
        elseif($role == "Admin")
            $color = "danger";
        elseif($role == "User")
            $color = "mint";

        return '<small><span class="label label-'.$color.'">'.$role.'</span></small>';
    }
}
