<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficAnalysisStruc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pcap_id')->constrained('pcaps');
            $table->foreignId('process_id')->constrained('processes');
            $table->text('ip_src');
            $table->text('ip_dst');
            $table->boolean('ip_src_is_locale');
            $table->boolean('ip_dst_is_locale');
            $table->boolean('is_eu');
            $table->text('city')->nullable();
            $table->text('country')->nullable();
            $table->text('asn')->nullable();
            $table->text('aso')->nullable();
        });

        Schema::create('tcps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ip_id')->constrained('ips');
            $table->text('port_src');
            $table->text('port_dst');
        });

        Schema::create('udps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ip_id')->constrained('ips');
            $table->text('port_src');
            $table->text('port_dst');
        });

        Schema::create('https', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tcp_id')->constrained('tcps');
            $table->text('url');
        });

        Schema::create('tls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tcp_id')->constrained('tcps');
            $table->text('sni')->nullable();
        });

        Schema::create('dns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('udp_id')->constrained('udps');
            $table->text('name');
        });

        Schema::create('dns_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dns_id')->constrained('dns');
            $table->text('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
