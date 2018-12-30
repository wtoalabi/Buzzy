<?php
  
  use App\User;
  use Faker\Factory as Faker;
  use App\Models\SocialProfile;
  use Illuminate\Database\Seeder;

class SocialProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $users = User::all();
      $users->each(function($user) use($faker){
        $networks = ['twitter','github','facebook','instagram'];
        for($count = rand(2,3); $count > 0;){
          $currentUserNetworks = $user->social_profiles->pluck('network');
          if(!$currentUserNetworks->contains($networks[$count])){
            factory(SocialProfile::class)->create([
              'user_id' => $user->id,
              'network' => $networks[$count],
              'username' => $faker->userName
            ]);
          }
          $count--;
        }
      });
    }
}
