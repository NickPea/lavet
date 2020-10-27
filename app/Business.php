<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //

    /** methods */

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function listing()
    {
        return $this->hasMany('App\Listing');
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
