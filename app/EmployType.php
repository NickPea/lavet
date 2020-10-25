<?php

namespace App;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class EmployType extends Model
{
    //
    use ModelHelper;

    /** methods */

    public function listing()
    {
        return $this->belongsToMany('App\Listing', 'employ_type_listing', 'employ_type_id', 'listing_id');
    }
}
