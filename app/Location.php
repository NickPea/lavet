<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function profile()
    {
        return $this->morphedByMany('App\Profile', 'locationable')
            ->withPivot(['description', 'is_main'])
            ->withTimestamps();
    }
    public function business()
    {
        return $this->morphedByMany('App\Business', 'locationable')
            ->withPivot(['description', 'is_main'])
            ->withTimestamps();
    }
    public function listing()
    {
        return $this->morphedByMany('App\Listing', 'locationable')
            ->withPivot(['description', 'is_main'])
            ->withTimestamps();
    }
    public function event()
    {
        return $this->morphedByMany('App\Event', 'locationable')
            ->withPivot(['description', 'is_main'])
            ->withTimestamps();
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    public function area_code()
    {
        return $this->belongsTo('App\AreaCode');
    }
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
    public function city()
    {
        return $this->belongsTo('App\City');
    }
    public function township()
    {
        return $this->belongsTo('App\Township');
    }
}