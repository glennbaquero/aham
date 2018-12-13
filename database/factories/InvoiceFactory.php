<?php

use Faker\Generator as Faker;

use App\Helpers;

$factory->define(App\Invoice::class, function (Faker $faker) {
    return [
        'serial_number' => $faker->unique()->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
        'purchase_date' => $faker->date('Y-m-d', 'now'),
        'contract_number' => $faker->unique()->numberBetween(1,999),
        'file_extension' => $faker->randomElement(array ('jpg','png','jpeg')),
        'date_of_purchase' => $faker->date('Y-m-d', 'now'),
        'expiration_date' => '2019-11-11',
        'applied_date' => $faker->date('Y-m-d', 'now'),
        'application_number' => $faker->numberBetween(999, 99999),
        'warranty_type' => $faker->numberBetween(0, 1),
    ];
});
