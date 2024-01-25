<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\BackupLogItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class BackupLogItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BackupLogItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'destination_id' => $this->faker->randomNumber(),
            'task' => $this->faker->text(255),
            'level' => $this->faker->text(255),
            'message' => $this->faker->text(),
            'source_id' => \App\Models\Source::factory(),
            'backup_id' => \App\Models\Backup::factory(),
        ];
    }
}
