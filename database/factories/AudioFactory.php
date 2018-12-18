<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Audio::class, function (Faker $faker) {
  $urls = ['armfather-am.mp3','cupluck.mp3','catblack.mp3','metbed.mp3','awaycinema.mp3','turnlearn-am.mp3','hitsitting.mp3'];
    return [
        'url' => $faker->randomElement($urls)
    ];
});
