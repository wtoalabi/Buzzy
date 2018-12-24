<?php
  /**
   * Created by Alabi Olawale
   * Date: 12/22/2018
   */
  
  namespace App\Helpers\WordsList;
  
  
  use Illuminate\Support\Facades\Redis;

  class Popular{
    public static function List($itemsCount=7){
      return Redis::ZREVRANGE("Views:PopularList:Words", 0,$itemsCount);
    }
  }