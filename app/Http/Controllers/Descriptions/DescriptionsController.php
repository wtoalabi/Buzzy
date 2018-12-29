<?php

namespace App\Http\Controllers\Descriptions;

use App\Models\Description;
use App\Models\Symbol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DescriptionsController extends Controller
{
    public function store(){
      $lastCreatedTime = auth()->user()->descriptions->last()->created_at;
      $now = now();
      $nowMinus30Seconds = $now->subSeconds(30);
      if($nowMinus30Seconds->lt($lastCreatedTime)){
        return response('Too fast! Slow down a bit!');
      }
        request()->validate([
          'description' => 'required'
        ],[
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
      $audio ? $description->audio()->sync($audio): '';
      $symbol  ? Symbol::create([
          'description_id' => $description->id,
          'symbol' => request('symbol')
        ]) : '';
      return $description;
      
    }
}
