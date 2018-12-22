<?php
/*  /**
   * Created by Alabi Olawale
   * Date: 12/22/2018
   */
  
  namespace App\Helpers\WordsList;
  
  
  use Illuminate\Support\Facades\Redis;

  class Trending
  {
    public static function List($daysCount)
    {
      $allDays = Redis::scan(0, 'match', 'Views:Daily*', 'Count', 10000);
      $sortedDays = collect(array_reverse(array_sort($allDays[1])))->take($daysCount)->toArray();
      $a = [];
      foreach ($sortedDays as $day){
        $a[] = Redis::ZREVRANGE($day, 0, 20, 'WITHSCORES');
      }
      $b = [];
      
      array_walk_recursive($a, function ($val, $key) use (&$b) {
        $b[$key] = $val;
      });
      return $b;
    }
  
  
    /*To be used by the scheduled runner*/
    public static function DeleteOldEntriesBy($days)
    {
      $allDays = Redis::scan(0, 'match', 'Views:Daily*', 'Count', 10000);
      $after = collect(array_reverse(array_sort($allDays[1])))->slice($days);
      return $after;
    }
  }