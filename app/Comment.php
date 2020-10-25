<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function rsvp()
    {
        return $this->belongsTo('App\Rsvp');
    }
    public function image()
    {
        return $this->morphToMany('App\Image', 'imageable')
            ->withPivot(['is_main', 'is_shown', 'is_logo'])
            ->withTimestamps();
    }
}
