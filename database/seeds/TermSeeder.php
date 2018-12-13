<?php
  
  use App\Models\Term;
  use App\User;
  use Faker\Factory as Faker;
  use Illuminate\Database\Seeder;
  
  class TermSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $terms = collect(['ISP','GIF','PNG','JPEG','Angular','Closure','Callback','Concurrency', 'Latency', 'Serverless','React', 'VUE', 'Library', 'Framework', 'Fullstack', 'Stack Overflow', 'Laravel', 'Django','Backend','Frontend']);
      $users =  User::all()->pluck('id')->toArray();
      $terms->each(function ($term) use ($users){
        $faker = Faker::create();
        factory(Term::class)->create(
          [
            'title' => $term,
            'user_id' => $faker->randomElement($users)
          ]);
      });
    }
  }
