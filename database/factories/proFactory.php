<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker -> name,
'description' =>$faker->sentence(5),
'image1'=>'http://lorempixel.com/480/640/nature/',
'image2'=>'http://lorempixel.com/480/640/nature/',
'image3'=>'http://lorempixel.com/480/640/nature/',
'price'=>$faker->numberBetween(1,10),
'rating'=>0,
'color'=>$faker->colorName(),
'user_id'=>$faker->numberBetween(1,10),
'category_id'=>$faker->numberBetween(1,7),
    ];
});
