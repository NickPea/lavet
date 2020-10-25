<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    use ModelHelper;

    /** mehtods */

    public function profile()
    {
        return $this->morphedByMany('App\Profile', 'positionable')
            ->withPivot('is_main')
            ->withTimestamps();
        }
        public function listing()
        {
        return $this->morphedByMany('App\Listing', 'positionable')
            ->withPivot('is_main')
            ->withTimestamps();
        }
}
