## Database backup

1. Run command `composer require hampni/backupdb`
2. Run command `php artisan vendor:publish --provider='Hampni\Backupdb\Providers\BackupDbProvider'`
3. Run command `php artisan migrate`
