<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Symbol::class, function (Faker $faker) {
    return [
        'description_id' => 1,
        'symbol' => $faker->word
    ];
});
