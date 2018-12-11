<?php

use Faker\Generator as Faker;

$factory->define(App\InvoiceItem::class, function (Faker $faker) {
	$price = $faker->numberBetween(999, 9999);
    return [
	    'product_id' => $faker->numberBetween(1, 4),
	    'invoice_id' => $faker->numberBetween(1, 50),
	    'unit_price' => $price,
	    'total_price' => $price,
	    'status' => $faker->numberBetween(0, 1),
    ];
});
