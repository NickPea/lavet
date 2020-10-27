<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployType extends Model
{
    //

    /** methods */

    public function listing()
    {
        return $this->belongsToMany('App\Listing', 'employ_type_listing', 'employ_type_id', 'listing_id');
    }
}
