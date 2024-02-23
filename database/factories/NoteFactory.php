<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $noteable = [Project::class, Ticket::class];

        return [
            'body' => $this->faker->paragraph(),
            'noteable_id' => $this->faker->numberBetween(0, 10),
            'noteable_type' => $this->faker->randomElement($noteable)
        ];
    }
}
