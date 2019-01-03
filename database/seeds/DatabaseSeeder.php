<?php
  
  use Illuminate\Database\Seeder;
  
  class DatabaseSeeder extends Seeder
  {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(ClearRedis::class);
      $this->call(UserSeeder::class);
      $this->call(TagSeeder::class);
      //$this->call(WordSeeder::class);
      //$this->call(AudioSeeder::class);
      //$this->call(WordTagsSeeder::class);
      //$this->call(DescriptionSeeder::class);
      //$this->call(DescriptionAudioSeeder::class);
      //$this->call(SocialProfileSeeder::class);
    }
  }
