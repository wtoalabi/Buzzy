<?php

namespace App\Http\Controllers\Terms;

use App\Http\Resources\TermList\ListCollection;
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
  
  public function popularTerms(){
    return new ListCollection(Term::all()->take(10));
  }
  public function recentTerms(){
    return new ListCollection(Term::orderBy('created_at','desc')->take(10)->get());
  }
  public function trendingTerms(){
    return new ListCollection(Term::orderBy('created_at','asc')->take(10)->get());
  }
}