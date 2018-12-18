<?php

namespace App\Http\Controllers\Audio;

use App\Models\Audio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller
{
  public function store()
  {
    $audio = request()->file('audio');
    request()->validate([
      'audio' => 'max:150'
    ],[
      'max' => 'The audio file cannot be more than 150 kilobytes'
    ]);
    $name = $audio->getClientOriginalName();
    $ext = $audio->getClientOriginalExtension();
    $user = auth()->user();
    if(!str_contains($name, $ext)){
      $name = "$name.$ext";
    }
    $audio->storeAs('audio/' . $user->id, "$name", 'public');
    $audio = Audio::create([
      'url' => "$name"
    ]);
    return $audio->id;
  }
  
  public function destroy($id){
      $user = auth()->user();
      $audio = Audio::find($id);
      $audio->delete();
      Storage::disk('public')->delete('audio/'.$user->id .'/'. $audio->url);
      return 'done';
  }
}
