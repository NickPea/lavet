<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    /** properties */
    protected $guarded = [];

    /** method */

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function profile()
    {
        return $this->morphedByMany('App\Profile', 'imageable')
            ->withPivot(['is_main', 'is_shown', 'is_logo'])
            ->withTimestamps();
    }
    public function business()
    {
        return $this->morphedByMany('App\Business', 'imageable')
            ->withPivot(['is_main', 'is_shown', 'is_logo'])
            ->withTimestamps();
    }
    public function listing()
    {
        return $this->morphedByMany('App\Listing', 'imageable')
            ->withPivot(['is_main', 'is_shown', 'is_logo'])
            ->withTimestamps();
    }
    public function event()
    {
        return $this->morphedByMany('App\Event', 'imageable')
            ->withPivot(['is_main', 'is_shown', 'is_logo'])
            ->withTimestamps();
    }
}
