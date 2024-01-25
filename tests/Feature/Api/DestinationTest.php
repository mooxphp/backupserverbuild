<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Destination;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationTest extends TestCase
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
    public function it_gets_destinations_list(): void
    {
        $destinations = Destination::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.destinations.index'));

        $response->assertOk()->assertSee($destinations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_destination(): void
    {
        $data = Destination::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.destinations.store'), $data);

        $this->assertDatabaseHas('backup_server_destinations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_destination(): void
    {
        $destination = Destination::factory()->create();

        $data = [
            'status' => $this->faker->word(),
            'name' => $this->faker->name(),
            'disk_name' => $this->faker->text(255),
            'keep_all_backups_for_days' => $this->faker->randomNumber(0),
            'keep_daily_backups_for_days' => $this->faker->randomNumber(0),
            'keep_weekly_backups_for_weeks' => $this->faker->randomNumber(0),
            'keep_monthly_backups_for_months' => $this->faker->randomNumber(0),
            'keep_yearly_backups_for_years' => $this->faker->randomNumber(0),
            'delete_oldest_backups_when_using_more_megabytes_than' => $this->faker->randomNumber(
                0
            ),
            'healthy_maximum_backup_age_in_days_per_source' => $this->faker->randomNumber(
                0
            ),
            'healthy_maximum_storage_in_mb_per_source' => $this->faker->randomNumber(
                0
            ),
            'healthy_maximum_storage_in_mb' => $this->faker->randomNumber(0),
            'healthy_maximum_inode_usage_percentage' => $this->faker->randomNumber(
                0
            ),
        ];

        $response = $this->putJson(
            route('api.destinations.update', $destination),
            $data
        );

        $data['id'] = $destination->id;

        $this->assertDatabaseHas('backup_server_destinations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_destination(): void
    {
        $destination = Destination::factory()->create();

        $response = $this->deleteJson(
            route('api.destinations.destroy', $destination)
        );

        $this->assertModelMissing($destination);

        $response->assertNoContent();
    }
}
