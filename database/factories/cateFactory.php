<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker -> name,
        'description' => $faker ->sentence(5),
        'status'=>$faker ->boolean(),
        'image' => 'http://lorempixel.com/480/640/nature/',
        'user_id' => $faker -> numberBetween(1,10),
    ];
});
