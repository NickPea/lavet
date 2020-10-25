<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    //
    use ModelHelper;

    /** methods */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

}
