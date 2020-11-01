<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Listing;
use Faker\Generator as Faker;

$factory->define(Listing::class, function (Faker $faker) {
    return [
        'title' => $faker->sentences(1, true),
        'about' => $faker->sentences(10, true),
        //
    ];
});
