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
        Schema::table('backup_server_backups', function (Blueprint $table) {
            $table
                ->foreign('source_id')
                ->references('id')
                ->on('backup_server_sources')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('destination_id')
                ->references('id')
                ->on('backup_server_destinations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('backup_server_backups', function (Blueprint $table) {
            $table->dropForeign(['source_id']);
            $table->dropForeign(['destination_id']);
        });
    }
};
