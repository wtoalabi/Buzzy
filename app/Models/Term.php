<?php
  
  namespace App\Models;
  
  use Illuminate\Database\Eloquent\Model;
  
  class Term extends Model
  {
    protected $fillable = ['title'];
    protected $with = ['comments','tags'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
      return $this->hasMany(Comment::class);
    }
    public function tags(){
      return $this->belongsToMany(Tag::class,'term_tags');
    }
  }
