<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Backup;

use App\Models\Source;
use App\Models\Destination;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackupTest extends TestCase
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
    public function it_gets_backups_list(): void
    {
        $backups = Backup::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.backups.index'));

        $response->assertOk()->assertSee($backups[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_backup(): void
    {
        $data = Backup::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.backups.store'), $data);

        $this->assertDatabaseHas('backup_server_backups', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_backup(): void
    {
        $backup = Backup::factory()->create();

        $source = Source::factory()->create();
        $destination = Destination::factory()->create();

        $data = [
            'status' => $this->faker->word(),
            'disk_name' => $this->faker->text(255),
            'path' => $this->faker->text(255),
            'size_in_kb' => $this->faker->randomNumber(),
            'real_size_in_kb' => $this->faker->randomNumber(),
            'completed_at' => $this->faker->dateTime(),
            'rsync_summary' => $this->faker->text(),
            'rsync_time_in_seconds' => $this->faker->randomNumber(),
            'rsync_current_transfer_speed' => $this->faker->text(255),
            'rsync_average_transfer_speed_in_MB_per_second' => $this->faker->text(
                255
            ),
            'source_id' => $source->id,
            'destination_id' => $destination->id,
        ];

        $response = $this->putJson(route('api.backups.update', $backup), $data);

        $data['id'] = $backup->id;

        $this->assertDatabaseHas('backup_server_backups', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_backup(): void
    {
        $backup = Backup::factory()->create();

        $response = $this->deleteJson(route('api.backups.destroy', $backup));

        $this->assertModelMissing($backup);

        $response->assertNoContent();
    }
}
