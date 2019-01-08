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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
      $path = $this->dbPath();
      $this->process = new Process(sprintf(
        'mysqldump %s > %s',
        config('database.connections.mysql.database'), "$path.sql"
      ));
      $s3 = Storage::disk('s3');
      $s3->put($path, "$path.sql");
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
        $this->info('The backup has been proceed successfully.');
      } catch (ProcessFailedException $exception) {
        $this->error('The backup process failed...');
      }
    }
    public function dbPath(){
      $date = sprintf("%s-%s-%s",now()->format('y'),now()->format('m'),now()->format('d'));
      $time = now()->format('h:iA');
      $backupsFolder = storage_path('backups');
      $folderPath = $backupsFolder .'/'.$date;
      if(!File::exists($folderPath)){
        File::makeDirectory($folderPath, $mode = 0777, true, true);
      }
      return "$folderPath/$time";
    }
}
