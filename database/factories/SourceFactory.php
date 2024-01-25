<?php

namespace Database\Factories;

use App\Models\Source;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Source::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
            'destination_id' => \App\Models\Destination::factory(),
        ];
    }
}
