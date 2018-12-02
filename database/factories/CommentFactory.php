<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    return [
        'term_id' => 1,
        'body' => $faker->sentence,
    ];
});
