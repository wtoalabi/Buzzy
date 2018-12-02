<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Sound::class, function (Faker $faker) {
    return [
        'comment_id' => 1,
        'url' => $faker->url
    ];
});
