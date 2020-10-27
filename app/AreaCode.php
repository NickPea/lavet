<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaCode extends Model
{
    //

    /** methods */

    public function location()
    {
        return $this->hasMany('App\Location');
    }
}
