<?php

namespace App;

use App\Models\Description;
use App\Models\SocialProfile;
use App\Models\Word;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'github_id','twitter_id','username','full_name', 'email', 'avatar'
    ];
    protected $withCount = ['descriptions','words'];
    protected $casts = [
      'changed_username' => 'bool'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function avatar(){
        return $this->avatar ? $this->avatarUrl() : 'storage/avatar/default.png';
    }
    public function words(){
        return $this->hasMany(Word::class);
    }
    public function descriptions(){
      return $this->hasMany(Description::class);
    }
  public function avatarUrl(){
    $userID = $this->id;
    if(str_contains($this->avatar, 'https://') || str_contains($this->avatar, 'http://')){
      return $this->avatar;
    }
    return "storage/avatar/$userID/$this->avatar";
  }
  public function social_profiles(){
      return $this->hasMany(SocialProfile::class);
  }
}
