<?php
  
  use App\Models\Description;
  use App\Models\Audio;
  use App\Models\Symbol;
  use App\Models\Tag;
  use App\Models\Word;
  use App\User;
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
      $users = User::all()->pluck('id');
      $words->each(function () use ($words,$users) {
        $wordsArray = $words->toArray();
        $usersArray = $users->toArray();
        $wordsCounter = rand(2, 5);
        while ($wordsCounter > 0) {
          $faker = Faker::create();
          $description = factory(Description::class)->create([
            'word_id' => $faker->randomElement($wordsArray),
            'user_id' => $faker->randomElement($usersArray)
          ]);
          factory(Audio::class)->create();
          $symbolsCounter = rand(0,1);
          while ($symbolsCounter > 0) {
            factory(Symbol::class)->create([
              'description_id' => $description->id
            ]);
            $symbolsCounter--;
          }
          $wordsCounter--;
        }
      });
    }
  }
