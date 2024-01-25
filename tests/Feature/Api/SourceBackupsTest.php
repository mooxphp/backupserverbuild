<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Source;
use App\Models\Backup;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceBackupsTest extends TestCase
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
    public function it_gets_source_backups(): void
    {
        $source = Source::factory()->create();
        $backups = Backup::factory()
            ->count(2)
            ->create([
                'source_id' => $source->id,
            ]);

        $response = $this->getJson(route('api.sources.backups.index', $source));

        $response->assertOk()->assertSee($backups[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_source_backups(): void
    {
        $source = Source::factory()->create();
        $data = Backup::factory()
            ->make([
                'source_id' => $source->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sources.backups.store', $source),
            $data
        );

        $this->assertDatabaseHas('backup_server_backups', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $backup = Backup::latest('id')->first();

        $this->assertEquals($source->id, $backup->source_id);
    }
}
