<?php
  
  use App\Models\Description;
  use App\Models\Sound;
  use App\Models\Symbol;
  use App\Models\Tag;
  use App\Models\Word;
  use Faker\Factory as Faker;
  use Illuminate\Database\Seeder;
  
  class DescriptionSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $words = Word::all()->pluck('id');
      $words->each(function ($wordID) use ($words) {
        $wordsArray = $words->toArray();
        $wordsCounter = rand(2, 5);
        while ($wordsCounter > 0) {
          $faker = Faker::create();
          $description = factory(Description::class)->create([
            'word_id' => $faker->randomElement($wordsArray)
          ]);
          $symbolsCounter = rand(0,1);
          while ($symbolsCounter > 0) {
            factory(Symbol::class)->create([
              'description_id' => $description->id
            ]);
            $symbolsCounter--;
          }
          $soundsCounter = rand(0,1);
          while ($soundsCounter > 0) {
            factory(Sound::class)->create([
              'description_id' => $description->id
            ]);
            $soundsCounter--;
          }
          $wordsCounter--;
        }
        return;
      });
    }
  }
