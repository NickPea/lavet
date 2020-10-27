<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //

    /** methods */

    public function profile()
    {
        return $this->morphedByMany('App\Profile', 'skillable')
            ->withPivot('is_main')
            ->withTimestamps();
    }
    public function listing()
    {
        return $this->morphedByMany('App\Listing', 'skillable')
            ->withPivot('is_main')
            ->withTimestamps();
    }
}
