<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Destination;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestinationControllerTest extends TestCase
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
    public function it_displays_index_view_with_destinations(): void
    {
        $destinations = Destination::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('destinations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.destinations.index')
            ->assertViewHas('destinations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_destination(): void
    {
        $response = $this->get(route('destinations.create'));

        $response->assertOk()->assertViewIs('app.destinations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_destination(): void
    {
        $data = Destination::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('destinations.store'), $data);

        $this->assertDatabaseHas('backup_server_destinations', $data);

        $destination = Destination::latest('id')->first();

        $response->assertRedirect(route('destinations.edit', $destination));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_destination(): void
    {
        $destination = Destination::factory()->create();

        $response = $this->get(route('destinations.show', $destination));

        $response
            ->assertOk()
            ->assertViewIs('app.destinations.show')
            ->assertViewHas('destination');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_destination(): void
    {
        $destination = Destination::factory()->create();

        $response = $this->get(route('destinations.edit', $destination));

        $response
            ->assertOk()
            ->assertViewIs('app.destinations.edit')
            ->assertViewHas('destination');
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

        $response = $this->put(
            route('destinations.update', $destination),
            $data
        );

        $data['id'] = $destination->id;

        $this->assertDatabaseHas('backup_server_destinations', $data);

        $response->assertRedirect(route('destinations.edit', $destination));
    }

    /**
     * @test
     */
    public function it_deletes_the_destination(): void
    {
        $destination = Destination::factory()->create();

        $response = $this->delete(route('destinations.destroy', $destination));

        $response->assertRedirect(route('destinations.index'));

        $this->assertModelMissing($destination);
    }
}
