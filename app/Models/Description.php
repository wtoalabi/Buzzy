<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Description extends Model
{
 protected $fillable = ['id', 'word_id','body'];
 protected $with = ['symbol', 'sound'];
 protected $withCount =['symbol','sound'];
  
  public function symbol(){
    return $this->hasOne(Symbol::class);
 }
 public function sound(){
    return $this->hasOne(Sound::class);
 }
 public function tags(){
    return $this->hasMany(Tag::class);
 }
}
