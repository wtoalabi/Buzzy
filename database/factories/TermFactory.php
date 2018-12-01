<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Term::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement(['GIF','JPEG']),
    ];
});
