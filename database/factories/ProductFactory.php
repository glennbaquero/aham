<?php

use Faker\Generator as Faker;

use App\Helpers;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'category_id' => function() {
        	return Helpers::randomOrCreate(App\Category::class)->id;
        },
		'type_id' => function() {
			return Helpers::randomOrCreate(App\Type::class)->id;
		},
		'model' => $faker->unique()->word,
		'name' => $faker->word,
		'description' => $faker->paragraph,
		'specification' => $faker->paragraph,
		'extended_amount' => $faker->randomNumber(4),
    ];
});
