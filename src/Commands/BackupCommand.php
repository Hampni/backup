<?php

namespace Hampni\Backupdb\Commands;

use Hampni\Backupdb\Models\Backup;
use Illuminate\Console\Command;

class BackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates database backup max';

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
     * @return int
     */
    public function handle()
    {

        //check if maximum amount reached
        if (Backup::count() == config('backup.backup_amount')) {
            //get and delete the oldest backup
            $id = Backup::orderBy('id')->first()->id;
            exec('rm ./database/Backup/backup-' . $id . '.sql');
            Backup::where('id', $id)->delete();
        }
        //last inserted id
        $lastId = Backup::latest('id')->first() ? Backup::latest('id')->first()->id : 0;

        //crating new backup and inserting in db
        exec('mysqldump -u ' . env('DB_USERNAME') . ' -p' . env('DB_PASSWORD') . ' ' . env('DB_DATABASE') . ' > database/Backup/backup-' . $lastId + 1 . '.sql');
        $newBackuptitle = 'backup-' . $lastId + 1 . '.sql';
        Backup::create([
            'title' => $newBackuptitle
        ]);

    }
}
