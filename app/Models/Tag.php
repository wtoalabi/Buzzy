<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['description_id','tag'];
  
  public function terms(){
    return $this->belongsToMany(Term::class, 'term_tags');
    }
}
