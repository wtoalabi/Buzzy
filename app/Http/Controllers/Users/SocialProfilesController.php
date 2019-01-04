<?php

namespace App\Http\Controllers\Users;

use App\Models\SocialProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialProfilesController extends Controller
{
    public function store($network){
      if(!auth()->check()){
        return response('You are not allowed to carry this action out!', 403);
      }
      $username = request('username');
      SocialProfile::create([
        'user_id' => auth()->id(),
        'username' => $username,
        'network' => $network
      ]);
      return auth()->user()->social_profiles->pluck('username','network');
    }
}
