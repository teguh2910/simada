<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\Document;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project' => $this->faker->word() . ' Project',
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'supplier' => $this->faker->company(),
            'part_number' => $this->faker->regexify('[A-Z]{3}-[0-9]{4}'),
            'status' => $this->faker->numberBetween(0, 3),
            'id_document' => function () {
                return Document::factory()->create()->id;
            },
            'file' => $this->faker->word() . '.pdf',
            'revise' => $this->faker->numberBetween(0, 2),
            'pic' => $this->faker->name(),
            'npk' => $this->faker->regexify('[A-Z]{3}-[0-9]{4}'),
            'is_need' => $this->faker->boolean(),
        ];
    }
}
