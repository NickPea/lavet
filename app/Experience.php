<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    /** properties */
    protected $dates = ['start_at', 'end_at'];

    /** methods */

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
