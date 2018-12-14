<?php
  
  namespace App\Http\Controllers\Words;
  
  use App\Http\Resources\SearchResults\WordResultsCollection;
  use App\Models\Word;
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  
  class WordsSearchController extends Controller
  {
    public function index()
    {
      $searchText = request('searchText');
      if($searchText !== null) {
        $result = Word::where('word', 'like', "%$searchText%")->get()->take(5);
        return new WordResultsCollection($result);
      }
    }
  }
