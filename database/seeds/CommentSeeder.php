<?php
  
  use App\Models\Comment;
  use App\Models\Sound;
  use App\Models\Symbol;
  use App\Models\Tag;
  use App\Models\Term;
  use Faker\Factory as Faker;
  use Illuminate\Database\Seeder;
  
  class CommentSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $terms = Term::all()->pluck('id');
      $terms->each(function ($termID) use ($terms) {
        $termsArray = $terms->toArray();
        $termsCounter = rand(2, 5);
        while ($termsCounter > 0) {
          $faker = Faker::create();
          $comment = factory(Comment::class)->create([
            'term_id' => $faker->randomElement($termsArray)
          ]);
          $symbolsCounter = rand(0,1);
          while ($symbolsCounter > 0) {
            factory(Symbol::class)->create([
              'comment_id' => $comment->id
            ]);
            $symbolsCounter--;
          }
          $soundsCounter = rand(0,1);
          while ($soundsCounter > 0) {
            factory(Sound::class)->create([
              'comment_id' => $comment->id
            ]);
            $soundsCounter--;
          }
          $termsCounter--;
        }
        return;
      });
    }
  }
