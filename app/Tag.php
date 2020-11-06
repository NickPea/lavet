<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    /** methods */

    public function listing()
    {
        return $this->morphedByMany('App\Listing', 'taggable')
            ->withTimestamps();
    }
    
    public function event()
    {
        return $this->morphedByMany('App\Event', 'taggable')
            ->withTimestamps();
    }
}
