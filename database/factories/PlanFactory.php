<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Empresarial', 'Básico', 'Estándar', 'Vip']),
            'price' => $this->faker->randomNumber(5),
            'download_speed'  => $this->faker->randomElement(['300 MB', '50 MB', '100 MB']),
            'upload_speed'  => $this->faker->randomElement(['300 MB', '50 MB', '100 MB']),
            
        ];
    }
}
