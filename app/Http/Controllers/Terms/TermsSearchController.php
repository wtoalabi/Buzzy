<?php
  
  namespace App\Http\Controllers\Terms;
  
  use App\Http\Resources\SearchResults\TermResultsCollection;
  use App\Models\Term;
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  
  class TermsSearchController extends Controller
  {
    public function index()
    {
      $searchText = request('searchText');
      if($searchText !== null) {
        $result = Term::where('title', 'like', "%$searchText%")->get()->take(10);
        return new TermResultsCollection($result);
      }
    }
  }
