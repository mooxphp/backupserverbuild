<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Source extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'status',
        'healthy',
        'name',
        'host',
        'ssh_user',
        'ssh_port',
        'ssh_private_key_file',
        'cron_expression',
        'pre_backup_commands',
        'post_backup_commands',
        'includes',
        'excludes',
        'destination_id',
        'cleanup_strategy_class',
        'keep_all_backups_for_days',
        'keep_daily_backups_for_days',
        'keep_weekly_backups_for_weeks',
        'keep_monthly_backups_for_months',
        'keep_yearly_backups_for_years',
        'delete_oldest_backups_when_using_more_megabytes_than',
        'healthy_maximum_backup_age_in_days',
        'healthy_maximum_storage_in_mb',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'backup_server_sources';

    protected $casts = [
        'pre_backup_commands' => 'array',
        'post_backup_commands' => 'array',
        'includes' => 'array',
        'excludes' => 'array',
    ];

    public function backups()
    {
        return $this->hasMany(Backup::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function backupLogItems()
    {
        return $this->hasMany(BackupLogItem::class);
    }
}
