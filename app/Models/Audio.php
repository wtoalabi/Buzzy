<?php
  
  namespace App\Models;
  
  use Illuminate\Database\Eloquent\Model;
  
  class Audio extends Model
  {
    protected $table = 'audios';
    protected $fillable = ['url'];
    
    public function description()
    {
      return $this->belongsToMany(Description::class, 'description_audio')->withTimestamps();
    }
    
    public function url()
    {
      $descriptionUserID = $this->description->first()->user_id;
      return "storage/audio/$descriptionUserID/$this->url";
    }
  }
