<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Description::class, function (Faker $faker) {
    return [
        'word_id' => 1,
        'body' => $faker->words(rand(450,900),true),
        'user_id' => 1
    ];
});
