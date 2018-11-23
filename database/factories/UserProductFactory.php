<?php

use Faker\Generator as Faker;

$factory->define(App\UserProduct::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'product_id' => $faker->numberBetween(1, 4),
        'serial_number' => $faker->unique()->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
        'purchase_date' => $faker->date('Y-m-d', 'now'),
        'contract_number' => $faker->unique()->numberBetween(1,999),
        'file_extension' => $faker->randomElement(array ('jpg','png','jpeg')),
        'date_of_purchase' => $faker->date('Y-m-d', 'now'),
        'expiration_date' => '2019-11-11',
        'applied_date' => $faker->date('Y-m-d', 'now'),
        'amount' => $faker->numberBetween(500, 5000),
        'application_number' => $faker->numberBetween(999, 99999),
        'warranty_type' => $faker->numberBetween(0, 1),
    ];
});
