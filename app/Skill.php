<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    use ModelHelper;

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
