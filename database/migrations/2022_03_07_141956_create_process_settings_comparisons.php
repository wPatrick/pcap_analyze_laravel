<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessSettingsComparisons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_settings_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_id')->constrained('processes');
            $table->foreignId('device_a')->constrained('process_devices');
            $table->foreignId('device_b')->constrained('process_devices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_settings_comparisons');
    }
}
