<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BackupLogItem extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'source_id',
        'backup_id',
        'destination_id',
        'task',
        'level',
        'message',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'backup_log_items';

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function backup()
    {
        return $this->belongsTo(Backup::class);
    }
}
