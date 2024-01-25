<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Source;

use App\Models\Destination;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceControllerTest extends TestCase
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

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_sources(): void
    {
        $sources = Source::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sources.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sources.index')
            ->assertViewHas('sources');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_source(): void
    {
        $response = $this->get(route('sources.create'));

        $response->assertOk()->assertViewIs('app.sources.create');
    }

    /**
     * @test
     */
    public function it_stores_the_source(): void
    {
        $data = Source::factory()
            ->make()
            ->toArray();

        $data['pre_backup_commands'] = json_encode(
            $data['pre_backup_commands']
        );
        $data['post_backup_commands'] = json_encode(
            $data['post_backup_commands']
        );
        $data['includes'] = json_encode($data['includes']);
        $data['excludes'] = json_encode($data['excludes']);

        $response = $this->post(route('sources.store'), $data);

        $data['pre_backup_commands'] = $this->castToJson(
            $data['pre_backup_commands']
        );
        $data['post_backup_commands'] = $this->castToJson(
            $data['post_backup_commands']
        );
        $data['includes'] = $this->castToJson($data['includes']);
        $data['excludes'] = $this->castToJson($data['excludes']);

        $this->assertDatabaseHas('backup_server_sources', $data);

        $source = Source::latest('id')->first();

        $response->assertRedirect(route('sources.edit', $source));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_source(): void
    {
        $source = Source::factory()->create();

        $response = $this->get(route('sources.show', $source));

        $response
            ->assertOk()
            ->assertViewIs('app.sources.show')
            ->assertViewHas('source');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_source(): void
    {
        $source = Source::factory()->create();

        $response = $this->get(route('sources.edit', $source));

        $response
            ->assertOk()
            ->assertViewIs('app.sources.edit')
            ->assertViewHas('source');
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

        $data['pre_backup_commands'] = json_encode(
            $data['pre_backup_commands']
        );
        $data['post_backup_commands'] = json_encode(
            $data['post_backup_commands']
        );
        $data['includes'] = json_encode($data['includes']);
        $data['excludes'] = json_encode($data['excludes']);

        $response = $this->put(route('sources.update', $source), $data);

        $data['id'] = $source->id;

        $data['pre_backup_commands'] = $this->castToJson(
            $data['pre_backup_commands']
        );
        $data['post_backup_commands'] = $this->castToJson(
            $data['post_backup_commands']
        );
        $data['includes'] = $this->castToJson($data['includes']);
        $data['excludes'] = $this->castToJson($data['excludes']);

        $this->assertDatabaseHas('backup_server_sources', $data);

        $response->assertRedirect(route('sources.edit', $source));
    }

    /**
     * @test
     */
    public function it_deletes_the_source(): void
    {
        $source = Source::factory()->create();

        $response = $this->delete(route('sources.destroy', $source));

        $response->assertRedirect(route('sources.index'));

        $this->assertModelMissing($source);
    }
}
