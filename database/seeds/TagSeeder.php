<?php
  
  use App\Models\Tag;
  use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      $tags = ['AI', 'Machine Learning', 'Blockchain', 'Frontend', 'Backend','Programming', 'Web Development','Game Development','Mobile Development'];
      for ($tag = count($tags); $tag>0;){
        $tag--;
        factory(Tag::class)->create([
          'tag' => $tags[$tag],
          'slug' => str_slug($tags[$tag])
        ]); 
      }
    }
}
