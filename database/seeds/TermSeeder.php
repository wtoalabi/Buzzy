<?php
  
  use App\Models\Term;
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
      $terms = ['ISP', 'Library', 'Framework', 'Fullstack', 'Stack Overflow'];
      $faker = Faker::create();
      $count = 10;
      while ($count >= 0) {
        factory(Term::class)->create(
          [
            'title' => $faker->randomElement($terms)
          ]);
        $count--;
      }
    }
  }
