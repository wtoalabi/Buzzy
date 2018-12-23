<?php
  /*  /**
     * Created by Alabi Olawale
     * Date: 12/22/2018
     */
  
  namespace App\Helpers\WordsList;
  
  
  use Illuminate\Support\Facades\Redis;
  
  class Trending
  {
    public static function List($daysCount = 7, $itemCountFromEachDay=10, $maxReturnedItems=8)
    {
      $allDays = Redis::scan(0, 'match', 'Views:Daily*', 'Count', 10000);
      $sortedDays = collect(array_reverse(array_sort($allDays[1])))->take($daysCount)->toArray();
      /*
       Each day in redis has a list of words viewed with a viewCount attached. To access these days, we need
       to retrieve all the available days in Redis. Note: we need a cron that keeps the list to just the last 7 days.
       Once we get the days, we sort them out in a descending order and take the required number of days, default being 7.
        At this point we have:
          "Views:DailyTrendingList:2019-01-01",
           "Views:DailyTrendingList:2018-12-31",
           "Views:DailyTrendingList:2018-12-30",
       */
      $a = [];
      foreach ($sortedDays as $day) {
        $a[] = Redis::ZREVRANGE($day, 0, $itemCountFromEachDay, 'WITHSCORES');
      }
      /*
      We take each given day from redis and go back again to retrieve the words(posts) within each day with their
      scores. At this point we have an array of arrays, looking like this.
      [
        [
          "23122018_2" => "2345",
        ],
        [
         "22122018_30" => "5",
         "22122018_2" => "10",
        ]
      ]
      The reason for the datestamp before each id like "23122018_" is so we can have multiple ids from different
      days when we merge all of them together. The dates were generated when storing the words views in redis.
       * */
      $b = [];
      array_walk_recursive($a, function ($val, $key) use (&$b) {
        $b[$key] = $val;
      });
      $b = array_sort($b);
      /*
       Now, we walk over the array and merge them into one big array, containing all the top words for all the days
       retrieved. Here is why the datestamps before each word id become useful. For instance, a word with an ID of 2
       might be the top word for two days. But if we dont have the date stamps, then array walk will just take the
       first day it encounters. Not good.
       What if the word had 20 views on the first day and 3,000 on the next one? So we get all the occurrence of each
       word for each retrieve day.
        At this point, our array looks like this:
        [
         "25122018_5" => "1",
         "24122018_31" => "2",
         "24122018_2" => "20",
         "24122018_31" => "3",
         "23122018_29" => "3",
         "22122018_24" => "3"
         "19122018_2" => "3"
        ]
      */
      return collect($b)->keyBy(function ($k, $value) {
        return substr($value, 9);
      })->sortByDesc(function ($value, $key) {
        return $value;
      })->take($maxReturnedItems)->keys()->toArray();
      /*
       1. We removed the date stamps attached to the keys.
       2. Then we sort the keys by their values.
       3. Then we take the keys of only the maxed total number of words, the default being 8.
       4. And finally, we turn  them into an array.
       */
    }
    public static function DeleteOldEntriesBy($days)
      /*TODO: To be used by the scheduled runner*/
    {
      $allDays = Redis::scan(0, 'match', 'Views:Daily*', 'Count', 10000);
      $after = collect(array_reverse(array_sort($allDays[1])))->slice($days);
      return $after;
    }
  }