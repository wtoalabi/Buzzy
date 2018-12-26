<?php

namespace App\Models;

use App\Helpers\Redis\Get;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Description extends Model
{
 protected $fillable = ['id', 'word_id','body','user_id'];
 protected $with = ['symbol', 'audio'];
 protected $withCount =['symbol','audio'];
 
 public function word(){
     return $this->belongsTo(Word::class);
 }
  public function symbol(){
    return $this->hasOne(Symbol::class);
 }
  public function audio(){
    return $this->belongsToMany(Audio::class,'description_audio')->withTimestamps();
  }
 public function tags(){
    return $this->hasMany(Tag::class);
 }
 public function user(){
    return $this->belongsTo(User::class);
 }
 public function liked(){
   $user = auth()->user();
    if($user){
      return Get::LikesCountFor($this,$user->id);
    }
    
 }
 public function likesCount(){
     return Get::TotalCountFor($this);
 }
}
