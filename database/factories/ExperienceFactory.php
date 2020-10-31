<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Experience;
use Faker\Generator as Faker;

$factory->define(Experience::class, function (Faker $faker) {
    return [
        'organisation' => $faker->company,
        'work_role' => $faker->jobTitle,
        'start_at' => $faker->date,
        'end_at' => $faker->date,
        
        //
    ];
});
