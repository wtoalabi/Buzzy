<?php
  
  use App\Models\Audio;
  use App\Models\Description;
  use App\Models\DescriptionAudio;
  use Illuminate\Database\Seeder;

class DescriptionAudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $count = Description::count();
      while($count > 0){
        factory(DescriptionAudio::class)->create([
          'description_id' => $count,
          'audio_id' => $count,
        ]);
        $count--;
      }
    }
}
