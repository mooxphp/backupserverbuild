<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Source;

use App\Models\Destination;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceTest extends TestCase
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
    public function it_gets_sources_list(): void
    {
        $sources = Source::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sources.index'));

        $response->assertOk()->assertSee($sources[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_source(): void
    {
        $data = Source::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sources.store'), $data);

        $this->assertDatabaseHas('backup_server_sources', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_source(): void
    {
        $source = Source::factory()->create();

        $destination = Destination::factory()->create();

        $data = [
            'status' => $this->faker->word(),
            'healthy' => $this->faker->numberBetween(0, 127),
            'name' => $this->faker->name(),
            'host' => $this->faker->text(255),
            'ssh_user' => $this->faker->text(255),
            'ssh_port' => $this->faker->randomNumber(0),
            'ssh_private_key_file' => $this->faker->text(255),
            'cron_expression' => $this->faker->text(255),
            'pre_backup_commands' => [],
            'post_backup_commands' => [],
            'includes' => [],
            'excludes' => [],
            'cleanup_strategy_class' => $this->faker->text(255),
            'keep_all_backups_for_days' => $this->faker->randomNumber(0),
            'keep_daily_backups_for_days' => $this->faker->randomNumber(0),
            'keep_weekly_backups_for_weeks' => $this->faker->randomNumber(0),
            'keep_monthly_backups_for_months' => $this->faker->randomNumber(0),
            'keep_yearly_backups_for_years' => $this->faker->randomNumber(0),
            'delete_oldest_backups_when_using_more_megabytes_than' => $this->faker->randomNumber(
                0
            ),
            'healthy_maximum_backup_age_in_days' => $this->faker->randomNumber(
                0
            ),
            'healthy_maximum_storage_in_mb' => $this->faker->randomNumber(0),
            'destination_id' => $destination->id,
        ];

        $response = $this->putJson(route('api.sources.update', $source), $data);

        $data['id'] = $source->id;

        $this->assertDatabaseHas('backup_server_sources', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_source(): void
    {
        $source = Source::factory()->create();

        $response = $this->deleteJson(route('api.sources.destroy', $source));

        $this->assertModelMissing($source);

        $response->assertNoContent();
    }
}
