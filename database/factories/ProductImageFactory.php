<?php

use Faker\Generator as Faker;

use App\Helpers;

$factory->define(App\ProductImage::class, function (Faker $faker) {
    return [
        'image' => Helpers::randomFile() ? Helpers::randomFile() : $faker->image('public/storage/tmp',400,300, null, false),
    ];
});
