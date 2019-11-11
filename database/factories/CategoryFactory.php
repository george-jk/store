<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'category_title'=>$faker->sentence(3),
        'category_description'=>$faker->text,
        'parent'=>$faker->numberBetween(0,5)
    ];
});
