<?php

namespace App\Http\Controllers\Terms;

use App\Http\Resources\Terms\TermsCollection;
use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsController extends Controller
{
protected $terms;
  public function index(){
    $this->terms = Term::all();
    return [
      'trending' => $this->trendingTerms(),
      'popular' => $this->popularTerms(),
      'recently' => $this->recentTerms()
    ];
    }
  
  public function popularTerms(){
    return new TermsCollection($this->terms);
  }
  public function recentTerms(){
    return new TermsCollection($this->terms);
  }
  public function trendingTerms(){
    return new TermsCollection($this->terms);
  }
}