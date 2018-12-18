<?php
  
  namespace App\Http\Controllers\Words;
  
  use App\Http\Resources\WordList\ListCollection;
  use App\Http\Resources\Words\SingleWordDetail;
  use App\Http\Resources\Words\WordsCollection;
  use App\Models\Audio;
  use App\Models\Description;
  use App\Models\Symbol;
  use App\Models\Word;
  use App\Models\WordTag;
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  use Illuminate\Support\Facades\DB;
  
  class WordsController extends Controller
  {
    public function index()
    {
      return [
        'popular' => $this->popularWords(),
        'recent' => $this->recentWords(),
        'trending' => $this->trendingWords(),
      ];
    }
    
    public function store()
    {
      $userID = auth()->user()->id;
      request()->validate([
        'word' => 'required|unique:words',
        'description' => 'required',
        'tags' => 'required',
      ],[
        'tags.required' => 'You need to select at least one Tag.',
        'word.unique' => 'The word already exists.'
      ]);
      //dd(request());
      $word = Word::create([
        'word' => request('word'),
        'slug' => str_slug(request('word')),
        'user_id' => $userID
      ]);
      $description = Description::create([
        'word_id' => $word->id,
        'user_id' => $userID,
        'body' => request('description')
      ]);
      $word->tags()->sync(request('tags'));
      if(request('audio') || request('symbols')){
        $description->audio()->sync(request('audio'));
        Symbol::create([
          'description_id' => $description->id,
          'symbol' => request('symbol')
        ]);
      }
    }
    
    public function show($word)
    {
      $word = Word::where('slug', $word)->firstorFail();
      return new SingleWordDetail($word);
    }
    
    public function popularWords()
    {
      $words = Word::all()->take(8);
      if($words){
        return new ListCollection($words);
      }
      return [];
    }
    
    public function recentWords()
    {
      $words = Word::orderBy('created_at', 'desc')->take(8)->get();
      if($words){
        return new ListCollection($words);
      }
      return [];
    }
    
    public function trendingWords()
    {
      $words = Word::orderBy('created_at', 'asc')->get();
      if($words->count() > 8){
        return new ListCollection($words->random(8));
      }
      return [];
    }
  }