<?php
  
  namespace App\Models;
  
  use App\User;
  use Illuminate\Database\Eloquent\Model;
  
  class Term extends Model
  {
    protected $fillable = ['title'];
    protected $with = ['comments','tags'];
    protected $withCount =['tags'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
      return $this->hasMany(Comment::class);
    }
    public function tags(){
      return $this->belongsToMany(Tag::class,'term_tags');
    }
    public function symbolsCount(){
      $count = [];
      foreach ($this->comments as $comment){
        $count[] = $comment->symbol_count;
      }
      return collect($count)->sum();
    }
    public function soundsCount(){
      $count = [];
      foreach ($this->comments as $comment){
        $count[] = $comment->sound_count;
      }
      return collect($count)->sum();
    }
    public function tagsCount(){
      return $this->tags_count;
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
  }
