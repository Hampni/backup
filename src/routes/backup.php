<?php

use Illuminate\Support\Facades\Route;

Route::get('/backupdb', [\Hampni\Backupdb\Http\Controllers\BackupController::class, 'index']);
