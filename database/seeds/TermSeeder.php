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
      $terms = collect(['ISP', 'Library', 'Framework', 'Fullstack', 'Stack Overflow']);
      $terms->each(function($term){
        factory(Term::class)->create(
          [
            'title' => $term,
          ]);
      });
    }
  }
