<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //

    /** methods */

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
