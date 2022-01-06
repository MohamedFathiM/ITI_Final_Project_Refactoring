<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'title' => $faker -> sentence(3),
        'description' => $faker -> sentence(5),
        'status' => $faker->boolean(),
        'user_id' => $faker->numberBetween(1,10),
    ];
});
