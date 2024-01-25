<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Backup;
use App\Models\BackupLogItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackupBackupLogItemsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_backup_backup_log_items(): void
    {
        $backup = Backup::factory()->create();
        $backupLogItems = BackupLogItem::factory()
            ->count(2)
            ->create([
                'backup_id' => $backup->id,
            ]);

        $response = $this->getJson(
            route('api.backups.backup-log-items.index', $backup)
        );

        $response->assertOk()->assertSee($backupLogItems[0]->task);
    }

    /**
     * @test
     */
    public function it_stores_the_backup_backup_log_items(): void
    {
        $backup = Backup::factory()->create();
        $data = BackupLogItem::factory()
            ->make([
                'backup_id' => $backup->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.backups.backup-log-items.store', $backup),
            $data
        );

        $this->assertDatabaseHas('backup_log_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $backupLogItem = BackupLogItem::latest('id')->first();

        $this->assertEquals($backup->id, $backupLogItem->backup_id);
    }
}
