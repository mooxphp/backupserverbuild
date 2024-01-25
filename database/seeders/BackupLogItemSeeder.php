<?php

namespace Database\Seeders;

use App\Models\BackupLogItem;
use Illuminate\Database\Seeder;

class BackupLogItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BackupLogItem::factory()
            ->count(5)
            ->create();
    }
}
