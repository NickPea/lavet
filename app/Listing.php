<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    //
    /** properties */
    protected $dates = ['created_at', 'updated_at'];

    /** helpers */
    public function path()
    {
        $className = strtolower(class_basename($this));
        return "{$className}/{$this->id}";
    }

    /** methods */

    public function business()
    {
        return $this->belongsTo('App\Business');
    }
    public function employ_type()
    {
        return $this->belongsToMany('App\EmployType','employ_type_listing', 'listing_id', 'employ_type_id');
    }
    public function image()
    {
        return $this->morphToMany('App\Image', 'imageable')
            ->withPivot(['is_main', 'is_shown', 'is_logo'])
            ->withTimestamps();
    }
    public function location()
    {
        return $this->morphToMany('App\Location', 'locationable')
            ->withPivot(['description', 'is_main'])
            ->withTimestamps();
    }
    public function position()
    {
        return $this->morphToMany('App\Position', 'positionable')
            ->withPivot('is_main')
            ->withTimestamps();
    }
    public function field()
    {
        return $this->morphToMany('App\Field', 'fieldable')
            ->withPivot('is_main')
            ->withTimestamps();
    }
    public function skill()
    {
        return $this->morphToMany('App\Skill', 'skillable')
            ->withPivot('is_main')
            ->withTimestamps();
    }
    public function tag()
    {
        return $this->morphToMany('App\Tag', 'taggable')
            ->withTimestamps();
    }


}
