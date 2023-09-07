<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Device;
use App\Models\Installation;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use GuzzleHttp\Promise\Create;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Plan::factory()->count(5)->create();
        Client::factory()->count(5)->create();
        Device::factory()->count(5)->create();
        Installation::factory()->count(5)->create();
        Subscription::factory()->count(10)->create();
        User::factory()->count(1)->create();
        // Installation::factory()->has(Client::factory()->count(2), 'id')->create();
        // Installation::factory()->has(Plan::factory()->count(1), 'plans_id')->create();
        // Installation::factory()->has(Device::factory()->count(1), 'id')->create();
    }
}
