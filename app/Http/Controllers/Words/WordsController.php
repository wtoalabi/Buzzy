<?php

namespace App\Http\Controllers\Words;

use App\Http\Resources\WordList\ListCollection;
use App\Http\Resources\Words\SingleWordDetail;
use App\Http\Resources\Words\WordsCollection;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WordsController extends Controller
{
  public function index(){
    return [
      'popular' => $this->popularWords(),
      'recent' => $this->recentWords(),
      'trending' => $this->trendingWords(),
    ];
    }
  public function show($word){
      $word =  Word::where('slug',$word)->firstorFail();
      return new SingleWordDetail($word);
  }
  public function popularWords(){
    return new ListCollection(Word::all()->take(8));
  }
  public function recentWords(){
    return new ListCollection(Word::orderBy('created_at','desc')->take(8)->get());
  }
  public function trendingWords(){
    return new ListCollection(Word::orderBy('created_at','asc')->get()->random(8));
  }
}