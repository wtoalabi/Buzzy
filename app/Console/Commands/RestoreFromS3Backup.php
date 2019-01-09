<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RestoreFromS3Backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore-from-s3{filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command automatically restores a database from a given file in S3 bucket.';

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
      $local = Storage::disk('local');
      $localFileName = "restore/backup.sql";
      $s3 = Storage::disk('s3');
      $name = $this->argument('filename');
      $this->info('Retrieving backup from S3...');
      $content = $s3->get($name);
      $local->put($localFileName,$content);
      $localFile = $local->get($localFileName);
      $this->info('Writing to the local server...');
      $this->info('Restoring backup to the database...');
      DB::unprepared($localFile);
      $this->info('Database fully restored...');
      $this->info('Deleting restoration file...');
      $local->delete($localFileName);
      $this->info('All done.');
    }
}
