## Database backup

1. Run command `composer require hampni/backupdb`
2. Run command `php artisan vendor:publish --provider='Hampni\Backupdb\Providers\BackupDbProvider'`
3. Run command `php artisan migrate`

You can adjust maximum amount of backups in `config/backup.php` `backup_amount`.
If you exceed maximum amount, the oldest one will be deleted

To create backup run command `php artisan backup:create`
