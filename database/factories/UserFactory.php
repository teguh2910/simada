<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'dept' => $this->faker->randomElement(['MIM', 'NPL', 'DEV', 'HR', 'FIN']),
            'npk' => $this->faker->unique()->numerify('NPK-####'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is an admin.
     *
     * @return $this
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'dept' => $this->faker->randomElement(['MIM', 'NPL']),
        ]);
    }
}
