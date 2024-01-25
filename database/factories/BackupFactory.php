<?php

namespace Database\Factories;

use App\Models\Backup;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BackupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Backup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
            'source_id' => \App\Models\Source::factory(),
            'destination_id' => \App\Models\Destination::factory(),
        ];
    }
}
