<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BackupLogItem;

use App\Models\Source;
use App\Models\Backup;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackupLogItemTest extends TestCase
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
    public function it_gets_backup_log_items_list(): void
    {
        $backupLogItems = BackupLogItem::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.backup-log-items.index'));

        $response->assertOk()->assertSee($backupLogItems[0]->task);
    }

    /**
     * @test
     */
    public function it_stores_the_backup_log_item(): void
    {
        $data = BackupLogItem::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.backup-log-items.store'), $data);

        $this->assertDatabaseHas('backup_log_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_backup_log_item(): void
    {
        $backupLogItem = BackupLogItem::factory()->create();

        $source = Source::factory()->create();
        $backup = Backup::factory()->create();

        $data = [
            'destination_id' => $this->faker->randomNumber(),
            'task' => $this->faker->text(255),
            'level' => $this->faker->text(255),
            'message' => $this->faker->text(),
            'source_id' => $source->id,
            'backup_id' => $backup->id,
        ];

        $response = $this->putJson(
            route('api.backup-log-items.update', $backupLogItem),
            $data
        );

        $data['id'] = $backupLogItem->id;

        $this->assertDatabaseHas('backup_log_items', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_backup_log_item(): void
    {
        $backupLogItem = BackupLogItem::factory()->create();

        $response = $this->deleteJson(
            route('api.backup-log-items.destroy', $backupLogItem)
        );

        $this->assertModelMissing($backupLogItem);

        $response->assertNoContent();
    }
}
