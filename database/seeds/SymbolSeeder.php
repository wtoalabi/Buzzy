<?php
  
  use App\Models\Description;
  use App\Models\Sound;
  use App\Models\Symbol;
  use Illuminate\Database\Seeder;

class SymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descriptions = Description::all()->pluck('id');
        $descriptions->each(function ($descriptionID){
          factory(Symbol::class)->create([
            'description_id' => $descriptionID
          ]);
          factory(Sound::class)->create([
            'description_id' => $descriptionID
          ]);
        });
    }
}
