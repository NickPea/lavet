<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** methods */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function business()
    {
        return $this->hasMany('App\Business');
    }

    public function event()
    {
        return $this->hasMany('App\Event');
    }

    public function rsvp()
    {
        return $this->hasMany('App\Rsvp');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function role()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function reference()
    {
        return $this->hasMany('App\Reference');
    }

    public function message()
    {
        return $this->hasMany('App\Message', 'author_id', 'id');
    }

    public function message_activity()
    {
        return $this->hasMany('App\MessageActivity', 'recipient_id');
    }
}
