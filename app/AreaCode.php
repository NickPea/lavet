<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaCode extends Model
{
    //
    /** properties */
    protected $guarded = [];

    /** methods */

    public function location()
    {
        return $this->hasMany('App\Location');
    }
}
