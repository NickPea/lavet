<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'is_free' => $faker->boolean,
        'about' => $faker->sentences(6, true),
        //
    ];
});
