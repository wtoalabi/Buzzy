<?php
  
  use App\Models\Description;
  use App\Models\Term;
  use Illuminate\Database\Seeder;

class DescriptionSeeder extends Seeder
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
          factory(Description::class)->create([
            'term_id' => $termID
          ]);
          $randomCounter--;
        }
      });
    }
}
