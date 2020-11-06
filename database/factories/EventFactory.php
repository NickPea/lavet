<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Event::class, function (Faker $faker) {
    $start_at = new Carbon($faker->dateTimeBetween('-5day', '+5day'));
    $end_at = new Carbon($start_at);
    $end_at->addHours(rand(1,8))->addMinutes(30);

    return [
        'title' => $faker->sentence(7, true),
        'about' => $faker->sentences(10, true),
        'seat_num' =>$faker->numberBetween(0,7),
        'start_at' => $start_at->toDateTimeString(),
        'end_at' => $end_at->toDateTimeString(),

        //
    ];
});
