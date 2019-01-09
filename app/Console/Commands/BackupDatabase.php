<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';
    protected $date;
    protected $name;
    protected $filePath;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
      $this->name = now()->format('h:iA');
      $this->date = sprintf("%s-%s-%s",now()->format('Y'),now()->format('m'),now()->format('d'));
      $dirPath = $this->dbPath();
      $this->filePath = "$dirPath/$this->name.sql";
      $this->process = new Process(sprintf(
        'mysqldump %s > %s',
        config('database.connections.mysql.database'), "$this->filePath"
      ));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      try {
        $this->process->mustRun();
        $this->pushToS3();
        $this->info('The backup has been proceed successfully.');
      } catch (ProcessFailedException $exception) {
        $this->error('The backup process failed...');
      }
    }
    public function dbPath(){
      $backupsFolder = storage_path('backups');
      $folderPath = $backupsFolder .'/'.$this->date;
      if(!File::exists($folderPath)){
        File::makeDirectory($folderPath, $mode = 0777, true, true);
      }
      return $folderPath;
    }
  
  private function pushToS3(){
    $s3 = Storage::disk('s3');
    $file = "$this->date/$this->name.sql";
    $s3->put("$file", file_get_contents($this->filePath));
  }
}
