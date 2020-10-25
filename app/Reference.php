<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
