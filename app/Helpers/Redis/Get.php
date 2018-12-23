<?php
  /**
   * Created by Alabi Olawale
   * Date: 12/23/2018
   */
  
  namespace App\Helpers\Redis;
  
  
  use Illuminate\Support\Facades\Redis;

  class Get{
    public static function LikesCountFor($description, $user){
      $descriptionFormat= static::GetFormat($description);
      return Redis::HGET($descriptionFormat, $user);
    }
  
    public static function TotalCountFor($description){
      $descriptionFormat = static::GetFormat($description);
      return Redis::HLEN($descriptionFormat);
    }
    
    private static function GetFormat($description){
      return sprintf("Likes:Descriptions:Word-%s:%s", $description->word->id,$description->id);
    }
  }