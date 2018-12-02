<?php
  
  use App\Models\Comment;
  use App\Models\Sound;
  use App\Models\Symbol;
  use App\Models\Tag;
  use App\Models\Term;
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
      $terms = Term::all()->pluck('id')->shuffle();
      $terms->each(function ($termID){
        $randomCounter = rand(2,5);
        while($randomCounter > 0){
          $comment = factory(Comment::class)->create([
            'term_id' => $termID
          ]);
          factory(Symbol::class)->create([
            'comment_id' => $comment->id
          ]);
          factory(Sound::class)->create([
            'comment_id' => $comment->id
          ]);
          $randomCounter--;
        }
      });
    }
}
