<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Profile extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function credential()
    {
        return $this->hasMany('App\Credential');
    }

    public function experience()
    {
        return $this->hasMany('App\Experience');
    }

    public function reference()
    {
        return $this->hasMany('App\Reference');
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
}
