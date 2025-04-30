<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OblDeviceManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        Schema::create('device_metas', function(Blueprint $table) {
            $table->id();
            $table->foreignId('manufacturer_id')->constrained('manufacturers');
            $table->foreignId('device_type_id')->constrained('device_types');
            $table->string('name');
            $table->integer('obl_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->date('date_of_receipt')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->string('typ')->nullable();
            $table->text('misc')->nullable();
            $table->timestamps();
        });

        Schema::create('devices', function(Blueprint $table) {
            $table->id();
            $table->foreignId('device_meta_id')->constrained('device_metas');
            $table->integer('number');
            $table->string('serial')->nullable();
            $table->string('mac')->nullable();
        });

        Schema::table('processes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('inventory_id');
            $table->integer('obl_id');
            $table->string('stage');
            $table->string('stage_text');
        });
        Schema::rename('processes', 'process');

        Schema::dropIfExists('device_ips');
        Schema::dropIfExists('process_settings_comparisons');
        Schema::dropIfExists('process_devices');

        Schema::create('process_devices', function(Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->constrained('process');
            $table->foreignId('device_id')->constrained('devices');
            $table->string('obl_ext');
        });

        Schema::create('device_ips', function(Blueprint $table) {
            $table->id();
            $table->foreignId('process_device_id')->constrained('process_devices');
            $table->string('ip');
        });

        Schema::create('process_device_comparisons', function(Blueprint $table) {
             $table->id();
             $table->foreignId('process_device_a_id')->constrained('process');
             $table->foreignId('process_device_b_id')->constrained('process');
        });

        Schema::table('pcaps', function(Blueprint $table) {
            $table->dropColumn('ip_connections');
            $table->dropColumn('eth_connections');
            $table->dropColumn('tcp');
            $table->dropColumn('udp');
            $table->dropColumn('http');
            $table->dropColumn('tls');
            $table->dropColumn('dns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
