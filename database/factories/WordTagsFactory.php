<?php

use Faker\Generator as Faker;

$factory->define(App\Models\WordTag::class, function (Faker $faker) {
    return [
        'word_id' => 1,
        'tag_id' => 1
    ];
});
