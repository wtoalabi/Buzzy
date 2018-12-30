<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SocialProfile::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'network' => 'twitter',
        'username' => 'test'
    ];
});
