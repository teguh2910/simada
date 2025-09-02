<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RFQ;
use App\Models\User;

class RFQFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RFQ::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'due_date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'project' => $this->faker->word() . ' Project',
            'part_number' => $this->faker->regexify('[A-Z]{3}-[0-9]{4}'),
            'status' => $this->faker->randomElement(['draft', 'sent', 'completed']),
            'created_by' => function () {
                return User::factory()->create()->id;
            },
            'attachments' => [],
        ];
    }

    /**
     * Indicate that the RFQ is in draft status.
     *
     * @return $this
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'sent_at' => null,
        ]);
    }

    /**
     * Indicate that the RFQ has been sent.
     *
     * @return $this
     */
    public function sent(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'sent',
            'sent_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }
}
