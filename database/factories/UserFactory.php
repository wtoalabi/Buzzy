<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'github_id' => 'g7B77UdFm', // secret,
        'username' => $faker->userName . '_'. str_random(rand(5,8)),
        'full_name' => $faker->name,
        'changed_username' => 0,
        'avatar' => null,
        'remember_token' => str_random(10),
    ];
});
