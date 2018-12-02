<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TermTag::class, function (Faker $faker) {
    return [
        'term_id' => 1,
        'tag_id' => 1
    ];
});
