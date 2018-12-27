<?php

namespace App\Http\Controllers\Users;

use App\Http\Resources\User\UserDetail;
use App\Http\Resources\Words\SingleWordDetail;
use App\Http\Resources\Words\WordsCollection;
use App\Models\Word;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class UsersController extends Controller{
    public function show($user){
      $user = User::where('username',$user)->first();
        return [
          'words' => new WordsCollection($user->words),
          'user' => new UserDetail($user)
        ];
    }
    public function loggedInUser(){
      $user = auth()->user();
      if($user){
        return new UserDetail($user);
      }
      return null;
    }
    public function bookmark($word){
      $word = Word::find($word);
      $user = auth()->user();
        if($word->bookmarked()){
          Redis::HDEL("Bookmarks:Users:$user->id", $word->id);
        }else{
          Redis::HSET("Bookmarks:Users:$user->id",$word->id,1);
        }
      return new SingleWordDetail($word);
    }
}
