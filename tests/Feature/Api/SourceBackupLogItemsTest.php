<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Source;
use App\Models\BackupLogItem;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceBackupLogItemsTest extends TestCase
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
    public function it_gets_source_backup_log_items(): void
    {
        $source = Source::factory()->create();
        $backupLogItems = BackupLogItem::factory()
            ->count(2)
            ->create([
                'source_id' => $source->id,
            ]);

        $response = $this->getJson(
            route('api.sources.backup-log-items.index', $source)
        );

        $response->assertOk()->assertSee($backupLogItems[0]->task);
    }

    /**
     * @test
     */
    public function it_stores_the_source_backup_log_items(): void
    {
        $source = Source::factory()->create();
        $data = BackupLogItem::factory()
            ->make([
                'source_id' => $source->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sources.backup-log-items.store', $source),
            $data
        );

        $this->assertDatabaseHas('backup_log_items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $backupLogItem = BackupLogItem::latest('id')->first();

        $this->assertEquals($source->id, $backupLogItem->source_id);
    }
}
