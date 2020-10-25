<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function location()
    {
        return $this->hasMany('App\Location');
    }
}
