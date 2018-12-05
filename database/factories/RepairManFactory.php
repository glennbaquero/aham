<?php

use Faker\Generator as Faker;

$factory->define(App\RepairMan::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'status' => $faker->numberBetween(0,1),
    ];
});
