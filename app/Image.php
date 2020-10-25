<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    use ModelHelper;

    /** method */

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
    public function comment()
    {
        return $this->morphedByMany('App\Comment', 'imageable')
            ->withPivot(['is_main', 'is_shown', 'is_logo'])
            ->withTimestamps();
    }
}
