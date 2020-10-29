<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //

    /** properties */
    protected $guarded = [];
    protected $touches = ['message_parent'];

    /** methods */

    public function user()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
    public function message_activity()
    {
        return $this->hasMany('App\MessageActivity');
    }
    /** message self relationship */
    public function message_child()
    {
        return $this->hasMany('App\Message', 'parent_id');
    }
    public function message_parent()
    {
        return $this->belongsTo('App\Message', 'parent_id');
    }
}
