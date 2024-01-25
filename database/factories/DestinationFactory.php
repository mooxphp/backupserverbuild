<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Destination::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
    }
}
