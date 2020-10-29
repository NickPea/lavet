<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    /** properties */
    protected $guarded = [];

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
