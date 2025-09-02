<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Document;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kinds_doc' => $this->faker->randomElement(['RFQ', 'Contract', 'Invoice', 'Specification']),
            'documents' => $this->faker->word() . ' Document',
        ];
    }
}
