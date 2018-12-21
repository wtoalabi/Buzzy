<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Description extends Model
{
 protected $fillable = ['id', 'word_id','body','user_id'];
 protected $with = ['symbol', 'audio'];
 protected $withCount =['symbol','audio'];
  
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
    $userID = auth()->user()->id;
     return Redis::HGET("Likes:Descriptions:description-$this->id", $userID);
 }
 public function likesCount(){
     return Redis::HLEN("Likes:Descriptions:description-$this->id");
 }
}
