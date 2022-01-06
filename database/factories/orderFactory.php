<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence(5),
'address'=>$faker->sentence(5),
'city'=>$faker->sentence(5),
'zipCode'=>$faker->sentence(5),
'phoneNumber'=>$faker->numberBetween(1,5),
'cart_id' =>$faker->numberBetween(1,15),
'subTotal' =>$faker->numberBetween(1,15),
    ];
});
