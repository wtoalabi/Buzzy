<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        'tag' => 'JS',
        'slug' => 'js'
    ];
});
