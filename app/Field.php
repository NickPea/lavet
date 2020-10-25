<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function profile()
    {
        return $this->morphedByMany('App\Profile', 'fieldable')
            ->withPivot('is_main')
            ->withTimestamps();
    }
    public function listing()
    {
        return $this->morphedByMany('App\Listing', 'fieldable')
            ->withPivot('is_main')
            ->withTimestamps();
    }
}
