<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
