<?php
  
  namespace App\Models;
  
  use App\User;
  use Illuminate\Database\Eloquent\Model;
  
  class Word extends Model
  {
    protected $fillable = ['word', 'sub_title','slug','user_id'];
    protected $with = ['descriptions','tags'];
    protected $withCount =['tags'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descriptions(){
      return $this->hasMany(Description::class);
    }
    public function sortedDescriptions(){
      $descriptionsWithCount = $this->descriptions->each(function ($description){
        return $description['likesCount'] = $description->likesCount();
      });
        return $descriptionsWithCount->sortByDesc('likesCount');
    }
    public function tags(){
      return $this->belongsToMany(Tag::class,'word_tags')->withTimestamps();
    }
    public function symbolsCount(){
      $count = [];
      foreach ($this->descriptions as $description){
        $count[] = $description->symbol_count;
      }
      return collect($count)->sum();
    }
    public function soundsCount(){
      $count = [];
      foreach ($this->descriptions as $description){
        $count[] = $description->sound_count;
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
