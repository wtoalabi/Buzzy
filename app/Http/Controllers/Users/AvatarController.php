<?php

namespace App\Http\Controllers\Users;

use App\Http\Resources\User\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
  public function store(){
    if(!auth()->check()){
      return response('You are not allowed to carry this action out!', 403);
    }
    $user = auth()->user();
    $video = request()->file('avatar');
    request()->validate([
      'video' => 'max:2000'
    ],[
      'max' => 'The video file cannot be more than 150 kilobytes'
    ]);
    $name = $video->getClientOriginalName();
    $ext = $video->getClientOriginalExtension();
    if(!str_contains($name, $ext)){
      $name = "$name.$ext";
    }
    if($user->avatar){
      Storage::disk('public')->delete('avatar/'.$user->id .'/'. $user->avatar);
    }
    $video->storeAs('avatar/' . $user->id, "$name", 'public');
    $user->avatar = $name;
    $user->save();
    return new UserDetail($user);
  }
  
  public function destroy(){
    $user = auth()->user();
    Storage::disk('public')->delete('avatar/'.$user->id .'/'. $user->avatar);
    $user->avatar = null;
    $user->save();
    return new UserDetail($user);
  }
}
