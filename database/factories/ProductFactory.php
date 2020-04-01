<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
	return [
		'name'=>$faker->sentence(3),
		'manifacture'=>$faker->company,
		'description'=>$faker->text,
		'exserpt_description'=>$faker->text(15),
		'category_id'=>factory(\App\Category::class),
		'price'=>$faker->randomFloat(2,0,200),
		'currency'=>$faker->currencyCode,
		'image_id'=>$faker->numberBetween(1,200)
	];
});
