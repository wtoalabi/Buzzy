<?php
namespace database\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Redis;
class ClearRedis extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Redis::FLUSHDB();
    }
}
