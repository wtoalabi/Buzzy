<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Symbol::class, function (Faker $faker) {
    return [
        'comment_id' => 1,
        'symbol' => $faker->word
    ];
});
