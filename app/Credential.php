<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    //
    /** properties */
    protected $guarded = [];

    /** methods */

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
