<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['description_id','tag','slug'];
  
  public function words(){
    return $this->belongsToMany(Word::class, 'word_tags');
    }
    public function getTagAttribute($value){
        return ucfirst($value);
    }
}
