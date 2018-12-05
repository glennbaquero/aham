<?php

use Faker\Generator as Faker;

$factory->define(App\UserDetail::class, function (Faker $faker) {
    return [
    	'user_id' => $faker->unique()->numberBetween(1, 50),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'contact' => $faker->phoneNumber,
        'bday_month' => $faker->month,
        'bday_day' => $faker->dayOfMonth,
        'bday_year' => $faker->year,
        'address' => $faker->address,
    ];
});
