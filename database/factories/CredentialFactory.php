<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Credential;
use Faker\Generator as Faker;

$factory->define(Credential::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'institution' => $faker->company." University",
        'end_at' => $faker->date(),
        //
    ];
});
