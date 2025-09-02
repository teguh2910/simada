<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Komentar;
use App\Models\Transaction;

class KomentarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Komentar::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_transactions' => function () {
                return Transaction::factory()->create()->id_transaction;
            },
            'pic_k' => $this->faker->name(),
            'npk_k' => $this->faker->regexify('[A-Z]{3}-[0-9]{4}'),
            'dep_k' => $this->faker->randomElement(['MIM', 'NPL', 'DEV', 'HR', 'FIN']),
            'komentar' => $this->faker->paragraph(),
        ];
    }
}
