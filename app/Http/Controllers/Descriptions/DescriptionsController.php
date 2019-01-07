<?php
  
  namespace App\Http\Controllers\Descriptions;

  use App\User;
  use App\Models\Symbol;
  use App\Models\Description;
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  use App\Http\Resources\Descriptions\UserDescriptionsCollection;

  class DescriptionsController extends Controller
  {
    public function index($user){
      $user = User::where('username', $user)->first();
      return $user->descriptions->isEmpty() ? 'None' : new UserDescriptionsCollection($user->descriptions->sortByDesc('created_at'));
    }
    public function store(){
      if(!auth()->check()){
        return response('You are not allowed to carry this action out!', 403);
      }
      $userDescriptions = auth()->user()->descriptions;
      if (!$userDescriptions->isEmpty()) {
        $lastCreatedTime = $userDescriptions->last()->created_at;
        $now = now();
        $nowMinus30Seconds = $now->subSeconds(30);
        if ($nowMinus30Seconds->lt($lastCreatedTime)) {
          return response('Too fast! Slow down a bit!', 405);
        }
      }
      request()->validate([
        'description' => 'required'
      ], [
        'description.required' => 'The description/comment field is required.'
      ]);
      $userID = auth()->user()->id;
      $description = Description::create([
        'word_id' => request('word'),
        'user_id' => $userID,
        'body' => request('description')
      ]);
      $audio = request('audio');
      $symbol = request('symbol');
      $audio ? $description->audio()->sync($audio) : '';
      $symbol ? Symbol::create([
        'description_id' => $description->id,
        'symbol' => request('symbol')
      ]) : '';
      return $description;
      
    }
  }