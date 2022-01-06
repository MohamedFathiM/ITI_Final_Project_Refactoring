<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductOrders;
use Faker\Generator as Faker;

$factory->define(ProductOrders::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1,10),
        'order_id'=> $faker->numberBetween(1,10),
        'status' =>$faker ->boolean(),
        'price'=> $faker->numberBetween(1,10),
    ];
});
