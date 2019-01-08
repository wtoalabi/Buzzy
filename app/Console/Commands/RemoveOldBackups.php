<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class RemoveOldBackups extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'db:remove-old-backup{daysToRemain=30}';
  
  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Remove outdated database backups';
  
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
  public function handle(){
    $daysToRemain = $this->argument('daysToRemain');
    $backupsPath = storage_path('backups');
    $allBackups = glob($backupsPath . '/*' , GLOB_ONLYDIR);
    collect(array_reverse(array_sort($allBackups)))
      ->splice($daysToRemain)->each(function($day){
        if(is_dir($day)){
          rmdir($day);
        }
      });
  }
}
