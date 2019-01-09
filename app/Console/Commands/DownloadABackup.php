<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadABackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:list-all-backups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A List of All DB Files in S3';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $all = collect(Storage::disk('s3')->allFiles());
        $all->each(function($each){
          echo $each . "\n";
        });
    }
}
