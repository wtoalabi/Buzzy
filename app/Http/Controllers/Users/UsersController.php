<?php
  
  namespace App\Http\Controllers\Users;
  
  use App\Helpers\Profiles\SocialProfiles;
  use App\Http\Resources\User\SocialProfilesCollection;
  use App\Http\Resources\User\UserDetail;
  use App\Http\Resources\Words\SingleWordDetail;
  use App\Http\Resources\Words\WordsCollection;
  use App\Models\Word;
  use App\User;
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  use Illuminate\Support\Facades\Redis;
  use Illuminate\Validation\Rule;

  class UsersController extends Controller
  {
    public function show($user)
    {
      $user = User::where('username', $user)->first();
      if($user) {
        return [
          'words' => new WordsCollection($user->words),
          'user' => new UserDetail($user),
          'social_profiles' => $user->social_profiles->pluck('username','network')
        ];
      }
      return response('User Profile not found', 404);
    }
    
    public function store()
    {
      if(!auth()->check()){
        return response('You are not allowed to carry this action out!', 403);
      }
      $user = auth()->user();
      request()->validate([
        'username' => Rule::unique('users')->ignore(auth()->id())
        //'username' => 'unique:users,email',
        //'email' => 'required','email'|'unique:users,email',
      ],[
        'username.unique' => 'Unfortunately, someone beat you to using :input as :attribute. You can try other simple permutations. '
      ]);
      $user->full_name = request('full_name');
      $user->username = request('username');
      if(request('username')){
        $user->changed_username = 1;
      }
      $user->save();
      return new UserDetail(User::find($user->id));
    }
    
    public function loggedInUser()
    {
      $user = auth()->user();
      if ($user) {
        return new UserDetail($user);
      }
      return null;
    }
    public function check(){
      return auth()->check() ? 'true' : 'false';
    }
  }
