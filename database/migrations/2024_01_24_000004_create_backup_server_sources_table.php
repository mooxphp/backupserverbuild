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
        Schema::create('backup_server_sources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->tinyInteger('healthy');
            $table->string('name');
            $table->string('host');
            $table->string('ssh_user');
            $table->integer('ssh_port');
            $table->string('ssh_private_key_file')->nullable();
            $table->string('cron_expression');
            $table->json('pre_backup_commands')->nullable();
            $table->json('post_backup_commands')->nullable();
            $table->json('includes')->nullable();
            $table->json('excludes')->nullable();
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->string('cleanup_strategy_class')->nullable();
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
            $table->integer('healthy_maximum_backup_age_in_days')->nullable();
            $table->integer('healthy_maximum_storage_in_mb')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_server_sources');
    }
};
