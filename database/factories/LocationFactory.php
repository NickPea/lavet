<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AreaCode;
use App\City;
use App\Country;
use App\Location;
use App\Province;
use App\Township;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'country_id' => Country::anyOf(),
        'area_code_id' => AreaCode::anyOf(),
        'province_id' => Province::anyOf(),
        'city_id' => City::anyOf(),
        'township_id' => Township::anyOf(),
    ];
});
