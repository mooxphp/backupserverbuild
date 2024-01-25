<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Backup;

use App\Models\Source;
use App\Models\Destination;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackupControllerTest extends TestCase
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
    public function it_displays_index_view_with_backups(): void
    {
        $backups = Backup::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('backups.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.backups.index')
            ->assertViewHas('backups');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_backup(): void
    {
        $response = $this->get(route('backups.create'));

        $response->assertOk()->assertViewIs('app.backups.create');
    }

    /**
     * @test
     */
    public function it_stores_the_backup(): void
    {
        $data = Backup::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('backups.store'), $data);

        $this->assertDatabaseHas('backup_server_backups', $data);

        $backup = Backup::latest('id')->first();

        $response->assertRedirect(route('backups.edit', $backup));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_backup(): void
    {
        $backup = Backup::factory()->create();

        $response = $this->get(route('backups.show', $backup));

        $response
            ->assertOk()
            ->assertViewIs('app.backups.show')
            ->assertViewHas('backup');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_backup(): void
    {
        $backup = Backup::factory()->create();

        $response = $this->get(route('backups.edit', $backup));

        $response
            ->assertOk()
            ->assertViewIs('app.backups.edit')
            ->assertViewHas('backup');
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

        $response = $this->put(route('backups.update', $backup), $data);

        $data['id'] = $backup->id;

        $this->assertDatabaseHas('backup_server_backups', $data);

        $response->assertRedirect(route('backups.edit', $backup));
    }

    /**
     * @test
     */
    public function it_deletes_the_backup(): void
    {
        $backup = Backup::factory()->create();

        $response = $this->delete(route('backups.destroy', $backup));

        $response->assertRedirect(route('backups.index'));

        $this->assertModelMissing($backup);
    }
}
