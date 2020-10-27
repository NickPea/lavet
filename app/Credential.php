<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    //

    /** methods */

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
