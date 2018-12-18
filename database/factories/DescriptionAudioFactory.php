<?php
  
  use App\Models\DescriptionAudio;
  use Faker\Generator as Faker;

$factory->define(DescriptionAudio::class, function (Faker $faker) {
    return [
      'description_id' => 1,
      'audio_id' => 1
    ];
});
