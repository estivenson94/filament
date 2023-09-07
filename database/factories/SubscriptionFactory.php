<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'client_id' => Client::factory(),
         'plan_id' => Plan::factory(),
         'state' =>$this->faker->boolean(),
         'discount' => $this->faker->randomFloat($min = 10000, $max = 50000 ),
         'apply_invoice' => $this->faker->boolean(),
        ];
    }
}
