<?php
  
  use App\Models\Description;
  use App\Models\Tag;
  use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          factory(Tag::class, 30)->create();
    }
}