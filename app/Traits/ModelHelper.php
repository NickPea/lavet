<?php 

namespace App\Traits;

/**
 * Global Helper Functions for Eloquent Models
 */
trait ModelHelper
{
    static public function anyOf()
    {
        return static::all()->random();
    }
}

