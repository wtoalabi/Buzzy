<?php

namespace App\Http\Controllers\Words;

use App\Http\Resources\Words\SingleWordDetail;
use App\Http\Resources\Words\WordsCollection;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class BookmarksController extends Controller
{
  public function index(){
    $user = auth()->user();
    $userBookmarks = Redis::HKEYS("Bookmarks:Users:$user->id");
    if($userBookmarks){
    $words = Word::findMany($userBookmarks);
      return new WordsCollection($words);
    }
    return 'None';
  }
  public function store($word){
    if(!auth()->check()){
      return response('You are not allowed to carry this action out!', 403);
    }
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
