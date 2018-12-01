<?php
  
  namespace App\Models;
  
  use Illuminate\Database\Eloquent\Model;
  
  class Term extends Model
  {
    protected $fillable = ['title'];
    protected $with = ['descriptions'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descriptions()
    {
      return $this->hasMany(Description::class);
    }
  }
