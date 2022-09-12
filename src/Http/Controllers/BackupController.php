<?php

namespace Hampni\Backupdb\Http\Controllers;

use App\Http\Controllers\Controller;
use Hampni\Backupdb\Models\Backup;

class BackupController extends Controller
{

    public function index()
    {
        $backups = Backup::all();

        return view('backupdb::index', [
            'backups' => $backups
        ]);
    }

}
