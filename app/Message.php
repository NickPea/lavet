<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function user()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
    public function message_user()
    {
        return $this->hasMany('App\MessageUser');
    }
}
