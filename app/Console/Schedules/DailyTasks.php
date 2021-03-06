<?php
  /**
   * Created by Alabi Olawale
   * Date: 1/8/2019
   */
  
  namespace App\Console\Schedules;
  
  
  use Illuminate\Support\Facades\Redis;

  class DailyTasks
  {
    public static function handle(){
      (new self)->TrimRedisList();
    }
    public function TrimRedisList(){
      $allDays = Redis::scan(0, 'match', 'Views:Daily*', 'Count', 10000);
      $sortedDays = collect(array_reverse(array_sort($allDays[1])))->slice(7);
      $sortedDays->each(function($day){
        Redis::Del($day);
      });
    }
  }