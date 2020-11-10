<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'path' => $faker->imageUrl(),
        'original_name' => $faker->word,
        'extension' => $faker->fileExtension,
        'mime_type' => $faker->mimeType,
        'size' => $faker->randomDigitNotNull

        //
    ];
});
