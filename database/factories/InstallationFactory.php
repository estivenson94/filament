<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Device;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Installation>
 */
class InstallationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       

        return [
            'installation_date' =>$this->faker->date(),
            'speed' => $this->faker->randomElement(['300 MB / 100 MB', '100 MB / 50 MB', '20 MB / 50 MB', '40 MB / 15 MB','10 MB / 40 MB']),
            'plan_plans_id' => Plan::factory(),
            'address' =>$this->faker->streetAddress(),
            'neighborhood' =>$this->faker->citySuffix(),
            'client_id' => Client::factory(),
            'wifi'=>$this->faker->company() . ' Network',
            'wifi_password'=>$this->faker->name() . ' password',
            'ppoe' => $this->faker->randomElement(['ppoe1', 'ppoe2 ppoe3', 'ppoe4', 'ppoe5','ppoe6']),
            'ppoe_password' => $this->faker->randomElement(['ppoe1', 'ppoe2 ppoe3', 'ppoe4', 'ppoe5','ppoe6']),
            'ip' => $this->faker->randomElement(['192.168.1.2', '192.168.1.3', '192.168.1.4', '192.168.1.6','192.168.1.8']),
            'device_id' => Device::factory()


        ];
    }
}
