<?php
  
  use App\Models\Tag;
  use App\Models\Term;
  use App\Models\TermTag;
  use Illuminate\Database\Seeder;
  
  class TermTagsSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $terms = Term::all();
      $terms->each(function ($term) {
        $tagsID = Tag::all()->shuffle()->take(rand(2, 5))->pluck('id');
        $tagsID->each(function ($tag) use ($term) {
          factory(TermTag::class)->create([
            'term_id' => $term->id,
            'tag_id' => $tag,
          ]);
        });
      });
    }
  }