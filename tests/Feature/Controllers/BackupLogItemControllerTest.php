<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BackupLogItem;

use App\Models\Source;
use App\Models\Backup;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackupLogItemControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_backup_log_items(): void
    {
        $backupLogItems = BackupLogItem::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('backup-log-items.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.backup_log_items.index')
            ->assertViewHas('backupLogItems');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_backup_log_item(): void
    {
        $response = $this->get(route('backup-log-items.create'));

        $response->assertOk()->assertViewIs('app.backup_log_items.create');
    }

    /**
     * @test
     */
    public function it_stores_the_backup_log_item(): void
    {
        $data = BackupLogItem::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('backup-log-items.store'), $data);

        $this->assertDatabaseHas('backup_log_items', $data);

        $backupLogItem = BackupLogItem::latest('id')->first();

        $response->assertRedirect(
            route('backup-log-items.edit', $backupLogItem)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_backup_log_item(): void
    {
        $backupLogItem = BackupLogItem::factory()->create();

        $response = $this->get(route('backup-log-items.show', $backupLogItem));

        $response
            ->assertOk()
            ->assertViewIs('app.backup_log_items.show')
            ->assertViewHas('backupLogItem');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_backup_log_item(): void
    {
        $backupLogItem = BackupLogItem::factory()->create();

        $response = $this->get(route('backup-log-items.edit', $backupLogItem));

        $response
            ->assertOk()
            ->assertViewIs('app.backup_log_items.edit')
            ->assertViewHas('backupLogItem');
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

        $response = $this->put(
            route('backup-log-items.update', $backupLogItem),
            $data
        );

        $data['id'] = $backupLogItem->id;

        $this->assertDatabaseHas('backup_log_items', $data);

        $response->assertRedirect(
            route('backup-log-items.edit', $backupLogItem)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_backup_log_item(): void
    {
        $backupLogItem = BackupLogItem::factory()->create();

        $response = $this->delete(
            route('backup-log-items.destroy', $backupLogItem)
        );

        $response->assertRedirect(route('backup-log-items.index'));

        $this->assertModelMissing($backupLogItem);
    }
}
