<?php
  
  use App\Models\Tag;
  use App\Models\Word;
  use App\Models\WordTag;
  use Illuminate\Database\Seeder;
  
  class WordTagsSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $words = Word::all();
      $words->each(function ($word) {
        $tagsID = Tag::all()->shuffle()->take(rand(2, 5))->pluck('id');
        $tagsID->each(function ($tag) use ($word) {
          factory(WordTag::class)->create([
            'word_id' => $word->id,
            'tag_id' => $tag,
          ]);
        });
      });
    }
  }