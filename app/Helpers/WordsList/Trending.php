<?php
  /*  /**
     * Created by Alabi Olawale
     * Date: 12/22/2018
     */
  
  namespace App\Helpers\WordsList;
  
  
  use Illuminate\Support\Facades\Redis;
  
  class Trending
  {
    public static function List($daysCount, $itemCount)
    {
      $allDays = Redis::scan(0, 'match', 'Views:Daily*', 'Count', 10000);
      $sortedDays = collect(array_reverse(array_sort($allDays[1])))->take($daysCount)->toArray();
      /*
        At this point we have:
          "Views:DailyTrendingList:2019-01-01",
           "Views:DailyTrendingList:2018-12-31",
           "Views:DailyTrendingList:2018-12-30",
       */
      $a = [];
      foreach ($sortedDays as $day) {
        $a[] = Redis::ZREVRANGE($day, 0, $itemCount, 'WITHSCORES');
      }
      /*
       At this point we an array of arrays, looking like this:
      [
        [
          "aq_2" => "2345",
        ],
        [
         "dq_30" => "5",
         "dq_4" => "10",
        ]
      ]
       * */
      $b = [];
      array_walk_recursive($a, function ($val, $key) use (&$b) {
        $b[$key] = $val;
      });
      $b = array_sort($b);
      /*
        At this point, we have merged all the arrays together into one. Looking like this:
        [
         "ax_5" => "1",
         "as_31" => "2",
         "aw_31" => "3",
         "cs_29" => "3",
         "af_24" => "3"
        ]
      */
      return collect($b)->keyBy(function ($k, $v) {
        return substr($v, 3);
      })->sortByDesc(function ($k, $v) {
        return $k;
      })->take(5)->keys()->toArray();
    }
    /*
      First, we need to remove the random strings attached to the keys. Then we sort the
     */
    
    /*To be used by the scheduled runner*/
    public static function DeleteOldEntriesBy($days)
    {
      $allDays = Redis::scan(0, 'match', 'Views:Daily*', 'Count', 10000);
      $after = collect(array_reverse(array_sort($allDays[1])))->slice($days);
      return $after;
    }
  }