<?php

use Faker\Generator as Faker;

use App\Helpers;

$factory->define(App\InvoiceItem::class, function (Faker $faker) {
	$price = $faker->numberBetween(999, 9999);
    return [
	    'product_id' => function() {
        	return Helpers::randomOrCreate(App\Product::class)->id;
        },
	    'unit_price' => $price,
	    'total_price' => $price,
	    'status' => $faker->numberBetween(0, 1),
    ];
});
