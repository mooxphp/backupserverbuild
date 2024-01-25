<?php

namespace Database\Seeders;

use App\Models\Backup;
use Illuminate\Database\Seeder;

class BackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Backup::factory()
            ->count(5)
            ->create();
    }
}
