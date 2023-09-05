<?php

use App\Models\Client;
use App\Models\Device;
use App\Models\Installation;
use App\Models\Plan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('installations', function (Blueprint $table) {
            $table->id();
            $table->string('installation_date',255);
            $table->string('speed',255);
            $table->foreignIdFor(Plan::class);
            $table->string('address',255);
            $table->string('neighborhood',255);
            $table->foreignIdFor(Client::class);
            $table->string('wifi',255);
            $table->string('wifi_password',255);
            $table->string('ppoe',255);
            $table->string('ppoe_password',255);
            $table->string('ip',255);
            $table->foreignIdFor(Device::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installations');
    }
};
