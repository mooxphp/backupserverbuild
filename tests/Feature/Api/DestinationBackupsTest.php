<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Backup;
use App\Models\Destination;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationBackupsTest extends TestCase
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
    public function it_gets_destination_backups(): void
    {
        $destination = Destination::factory()->create();
        $backups = Backup::factory()
            ->count(2)
            ->create([
                'destination_id' => $destination->id,
            ]);

        $response = $this->getJson(
            route('api.destinations.backups.index', $destination)
        );

        $response->assertOk()->assertSee($backups[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_destination_backups(): void
    {
        $destination = Destination::factory()->create();
        $data = Backup::factory()
            ->make([
                'destination_id' => $destination->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.destinations.backups.store', $destination),
            $data
        );

        $this->assertDatabaseHas('backup_server_backups', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $backup = Backup::latest('id')->first();

        $this->assertEquals($destination->id, $backup->destination_id);
    }
}
