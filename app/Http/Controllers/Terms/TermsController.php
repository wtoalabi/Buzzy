<?php

namespace App\Http\Controllers\Terms;

use App\Http\Resources\TermList\ListCollection;
use App\Http\Resources\Terms\SingleTermDetail;
use App\Http\Resources\Terms\TermsCollection;
use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
  public function index(){
    return [
      'popular' => $this->popularTerms(),
      'recent' => $this->recentTerms(),
      'trending' => $this->trendingTerms(),
    ];
    }
  public function show($item){
      $item =  Term::where('title',$item)->firstorFail();
      return new SingleTermDetail($item);
  }
  public function popularTerms(){
    return new ListCollection(Term::all()->take(8));
  }
  public function recentTerms(){
    return new ListCollection(Term::orderBy('created_at','desc')->take(8)->get());
  }
  public function trendingTerms(){
    return new ListCollection(Term::orderBy('created_at','asc')->get()->random(8));
  }
}