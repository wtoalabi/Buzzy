<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['description_id','tag'];
  
  public function words(){
    return $this->belongsToMany(Word::class, 'word_tags');
    }
}
