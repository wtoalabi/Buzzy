<?php
  /**
   * Created by Alabi Olawale
   * Date: 12/23/2018
   */
  
  namespace App\Helpers\Redis;
  
  
  use Carbon\Carbon;
  use Illuminate\Support\Facades\Redis;

  class Store
  {
    public static function WordsViewCount($wordID)
    {
      $now = Carbon::now();
      $today = $now->toDateString();
      $dateString = sprintf("%s%s%s_", $now->day,$now->month, $now->year);
      
      Redis::ZINCRBY("Views:DailyTrendingList:$today", 1, $dateString."$wordID");
      Redis::ZINCRBY("Views:PopularList:Words", 1, "$wordID");
    }
  
    public static function LikesCountFor($user, $description){
      $descriptionFormat = sprintf("Likes:Descriptions:Word-%s:%s", $description->word->id,$description->id);
      if($description->liked()){
        Redis::HDEL($descriptionFormat, $user);
      }else{
        Redis::HSET($descriptionFormat, $user, 1);
      }
    }
  }