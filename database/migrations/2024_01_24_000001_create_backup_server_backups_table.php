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
        Schema::create('backup_server_backups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('destination_id');
            $table->string('disk_name');
            $table->string('path')->nullable();
            $table->unsignedBigInteger('size_in_kb')->nullable();
            $table->unsignedBigInteger('real_size_in_kb')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('rsync_summary')->nullable();
            $table->bigInteger('rsync_time_in_seconds')->nullable();
            $table->string('rsync_current_transfer_speed')->nullable();
            $table
                ->string('rsync_average_transfer_speed_in_MB_per_second')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_server_backups');
    }
};
