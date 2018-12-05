<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
  $tags = ['Laravel', 'PHP', 'JS', 'ES6', 'VueJS','ReactJS', 'CSS','HTML'];
    return [
        'tag' => $faker->randomElement($tags),
    ];
});
