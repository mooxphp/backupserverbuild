<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('backup_server_destinations', function (
            Blueprint $table
        ) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->string('name');
            $table->string('disk_name');
            $table->integer('keep_all_backups_for_days')->nullable();
            $table->integer('keep_daily_backups_for_days')->nullable();
            $table->integer('keep_weekly_backups_for_weeks')->nullable();
            $table->integer('keep_monthly_backups_for_months')->nullable();
            $table->integer('keep_yearly_backups_for_years')->nullable();
            $table
                ->integer(
                    'delete_oldest_backups_when_using_more_megabytes_than'
                )
                ->nullable();
            $table
                ->integer('healthy_maximum_backup_age_in_days_per_source')
                ->nullable();
            $table
                ->integer('healthy_maximum_storage_in_mb_per_source')
                ->nullable();
            $table->integer('healthy_maximum_storage_in_mb')->nullable();
            $table
                ->integer('healthy_maximum_inode_usage_percentage')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_server_destinations');
    }
};
