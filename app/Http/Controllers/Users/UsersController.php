<?php

namespace App\Http\Controllers\Users;

use App\Http\Resources\User\UserDetail;
use App\Http\Resources\Words\WordsCollection;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
