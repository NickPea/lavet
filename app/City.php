<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
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
