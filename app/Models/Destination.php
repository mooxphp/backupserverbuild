<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'status',
        'name',
        'disk_name',
        'keep_all_backups_for_days',
        'keep_daily_backups_for_days',
        'keep_weekly_backups_for_weeks',
        'keep_monthly_backups_for_months',
        'keep_yearly_backups_for_years',
        'delete_oldest_backups_when_using_more_megabytes_than',
        'healthy_maximum_backup_age_in_days_per_source',
        'healthy_maximum_storage_in_mb_per_source',
        'healthy_maximum_storage_in_mb',
        'healthy_maximum_inode_usage_percentage',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'backup_server_destinations';

    public function backups()
    {
        return $this->hasMany(Backup::class);
    }

    public function sources()
    {
        return $this->hasMany(Source::class);
    }
}
