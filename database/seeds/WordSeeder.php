<?php
  
  use App\Models\Word;
  use App\User;
  use Faker\Factory as Faker;
  use Illuminate\Database\Seeder;
  
  class WordSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $words = collect(['ISP','GIF','PNG','JPEG','Angular','Closure','Callback','Concurrency', 'Latency', 'Serverless','React', 'VUE', 'Library', 'Framework', 'Fullstack', 'Stack Overflow', 'Laravel', 'Django','LAMP','LEMP','Lambda','Lua','Lighthouse','Cache','CRUD','CRM','ORM','Config','Crypt','Console','Cookie']);
      $users =  User::all()->pluck('id')->toArray();
      $words->each(function ($word) use ($users){
        $faker = Faker::create();
        factory(Word::class)->create(
          [
            'word' => $word,
            'slug' => str_slug($word),
            'user_id' => $faker->randomElement($users)
          ]);
      });
    }
  }
