<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Backup extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'status',
        'source_id',
        'destination_id',
        'disk_name',
        'path',
        'size_in_kb',
        'real_size_in_kb',
        'completed_at',
        'rsync_summary',
        'rsync_time_in_seconds',
        'rsync_current_transfer_speed',
        'rsync_average_transfer_speed_in_MB_per_second',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'backup_server_backups';

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
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
