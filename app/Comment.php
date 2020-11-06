<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    /** properties */
    protected $guarded = [];

    /** methods */

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comment_child()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }

    public function comment_parent()
    {
        return $this->belongsTo('App\Comment', 'parent_id');
    }

}
