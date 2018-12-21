<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
        'address' => $faker->address,
        'contacts' => [
        	$faker->phoneNumber,
        	$faker->phoneNumber,
        	$faker->phoneNumber,
        ],
        'emails' => [
        	$faker->safeEmail,
        	$faker->safeEmail,
        	$faker->safeEmail,
        ],
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
    ];
});
