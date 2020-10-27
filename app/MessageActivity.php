<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageActivity extends Model
{

    /** properties */
    
    protected $guarded = [];

    /** methods */

    public function user()
    {
        return $this->belongsTo('App\User', 'recipient_id');
    }
    public function message()
    {
        return $this->belongsTo('App\Message');
    }

}
