<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
