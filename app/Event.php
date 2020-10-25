<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function rsvp()
    {
        return $this->hasMany('App\Rsvp');
    }
    public function image()
    {
        return $this->morphToMany('App\Image', 'imageable')
            ->withPivot(['is_main', 'is_shown', 'is_logo'])
            ->withTimestamps();
    }
    public function location()
    {
        return $this->morphToMany('App\Location', 'locationable')
            ->withPivot(['description', 'is_main'])
            ->withTimestamps();
    }
}
