<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Source;
use App\Models\Destination;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationSourcesTest extends TestCase
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
    public function it_gets_destination_sources(): void
    {
        $destination = Destination::factory()->create();
        $sources = Source::factory()
            ->count(2)
            ->create([
                'destination_id' => $destination->id,
            ]);

        $response = $this->getJson(
            route('api.destinations.sources.index', $destination)
        );

        $response->assertOk()->assertSee($sources[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_destination_sources(): void
    {
        $destination = Destination::factory()->create();
        $data = Source::factory()
            ->make([
                'destination_id' => $destination->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.destinations.sources.store', $destination),
            $data
        );

        $this->assertDatabaseHas('backup_server_sources', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $source = Source::latest('id')->first();

        $this->assertEquals($destination->id, $source->destination_id);
    }
}
