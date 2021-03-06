<?php
  
  namespace App\Http\Controllers\Words;
  
  use App\Helpers\Redis\Store;
  use App\Helpers\WordsList\Popular;
  use App\Helpers\WordsList\Trending;
  use App\Http\Resources\WordList\ListCollection;
  use App\Http\Resources\Words\SingleWordDetail;
  use App\Models\Description;
  use App\Models\SuggestedTag;
  use App\Models\Symbol;
  use App\Models\Word;
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  use mysql_xdevapi\Exception;
  
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
      if (!auth()->check()) {
        return response('You are not allowed to carry this action out!', 403);
      }
      $userWords = auth()->user()->words;
      if (!$userWords->isEmpty()) {
        $lastCreatedTime = $userWords->last()->created_at;
        $now = now();
        $nowMinus30Seconds = $now->subSeconds(30);
        if ($nowMinus30Seconds->lt($lastCreatedTime)) {
          return response('Too fast! Slow down a bit!', 405);
        }
      }
      $userID = auth()->user()->id;
      request()->validate([
        'word' => 'required|unique:words|max:15',
        'sub_title' => 'nullable',
        'description' => 'required',
        'tags' => 'required',
      ], [
        'description.required' => 'The description/comment field is required.',
        'word.max' => 'You cant have more than :max characters. The suggestion is to make it short and simple, then give the full name in the (Buzzword in Full) section below.',
        'tags.required' => 'You need to select at least one Tag.',
        'word.unique' => 'The word already exists.'
      ]);
      $word = Word::create([
        'word' => request('word'),
        'sub_title' => request('sub_title'),
        'slug' => str_slug(request('word')),
        'user_id' => $userID
      ]);
      $description = Description::create([
        'word_id' => $word->id,
        'user_id' => $userID,
        'body' => request('description')
      ]);
      $word->tags()->sync(request('tags'));
      $audio = request('audio');
      $symbol = request('symbol');
      $audio ? $description->audio()->sync(request('audio')) : '';
      $symbol ?
        Symbol::create([
          'description_id' => $description->id,
          'symbol' => request('symbol')
        ]) : '';
      $suggestedTags = request('suggestedTags');
      if ($suggestedTags) {
        collect($suggestedTags)->each(function ($tag) use ($userID) {
          SuggestedTag::create([
            'user_id' => $userID,
            'tag' => $tag
          ]);
        });
      }
      return $word->slug;
    }
    
    public function show($word)
    {
      $word = Word::where('slug', $word)->first();
      if ($word) {
        Store::WordsViewCount($word->id);
        return new SingleWordDetail($word);
      }
      return response('Word not found...', 404);
    }
    
    public function wordIndex()
    {
      //return Word::all()->pluck('slug','word');
      $words = Word::all();
      return $words->pluck('slug')
        ->sort()
        ->groupBy(function ($word, $key) {
          return str_limit($word, 1, '');
        });
    }
    
    public function recentWords()
    {
      $words = Word::orderBy('created_at', 'desc')->take(8)->get();
      if ($words) {
        return new ListCollection($words);
      }
      return [];
    }
    
    public function popularWords()
    {
      $ids = Popular::List(7);
      $sorted = $this->findToSort($ids);
      return new ListCollection($sorted);
    }
    
    public function trendingWords()
    {
      $ids = Trending::List(10, 10, 8);
      $sorted = $this->findToSort($ids);
      return new ListCollection($sorted);
    }
    
    private function findToSort($ids)
    {
      $words = Word::findMany($ids);
      return $words->sortBy(function ($model) use ($ids) {
        return array_search($model->getKey(), $ids);
      });
    }
  }