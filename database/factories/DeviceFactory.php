<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->randomElement(['Huawei', 'Mercusys', 'Mitrastar', 'Tenda','Tp-Link']),
            'reference' => $this->faker->randomElement(['ASUS RT-AX88U', 'TP-Link Archer C9', 'Linksys EA9500', 'Xiaomi Mi Router 4','Tp-Netgear Nighthawk AX12']),
            'mac' => $this->faker->randomElement(['D4:6E:0E:75:57:A5', 'C0-A5-DD-19-E3-D1', '74:DA:88:19:12:DB', 'C0-A5-DD-19-E5-11','C4:71:54:5C:89:5A']),
        ];
    }
}
