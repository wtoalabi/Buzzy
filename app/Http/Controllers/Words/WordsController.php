<?php
  
  namespace App\Http\Controllers\Words;
  
  use App\Helpers\Redis\Store;
  use App\Http\Resources\WordList\ListCollection;
  use App\Http\Resources\Words\SingleWordDetail;
  use App\Models\Description;
  use App\Models\SuggestedTag;
  use App\Models\Symbol;
  use App\Models\Word;
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;

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
      if (request('audio') || request('symbols')) {
        $description->audio()->sync(request('audio'));
        Symbol::create([
          'description_id' => $description->id,
          'symbol' => request('symbol')
        ]);
      }
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
      $word = Word::where('slug', $word)->firstorFail();
      Store::WordsViewCount($word->id);
      return new SingleWordDetail($word);
    }
  
    public function popularWords()
    {
      //$ids = Popular::Get();
      $words = Word::all()->take(8);
      if ($words) {
        return new ListCollection($words);
      }
      return [];
    }
  
    public function recentWords()
    {
      $words = Word::orderBy('created_at', 'desc')->take(8)->get();
      if ($words) {
        return new ListCollection($words);
      }
      return [];
    }
  
    public function trendingWords()
    {
      //$ids = Trending::Get();
    
      /*      $words = Word::orderBy('created_at', 'asc')->get();
            if($words->count() > 8){
              return new ListCollection($words->random(8));
            }
            return [];
          }*/
    }
  }