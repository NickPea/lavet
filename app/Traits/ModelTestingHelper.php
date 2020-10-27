<?php 

namespace App\Traits;

/**
 * Global Domain Specific Testing Helper Functions for Eloquent Model Class
 *      ---- Remove from Eloquent Model Class in production ----
 */
trait ModelTestingHelper
{
    static public function anyOf()
    {
        return static::all()->random();
    }
    static public function anyParent()
    {
        return static::all()->where('parent_id', null)->random();
    }
    static public function anyChild()
    {
        return static::all()->where('parent_id', '<>', null)->random();
    }
}


