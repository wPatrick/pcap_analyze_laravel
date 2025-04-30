<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesCascadeDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pcaps', function(Blueprint $table) {
            $table->dropForeign(['process_id']);
            $table->foreign("process_id")->references('id')->on('processes')->onDelete('cascade');
            //$table->foreignId("process_id")->constrained('processes')->change()->onDelete('cascade');
        });

        Schema::table('ips', function(Blueprint $table) {
            $table->dropForeign(['pcap_id']);
            $table->dropForeign(['process_id']);
            $table->foreign("pcap_id")->references('id')->on('pcaps')->onDelete('cascade');
            $table->foreign("process_id")->references('id')->on('processes')->onDelete('cascade');
            //$table->foreignId('pcap_id')->change()->constrained('pcaps')->onDelete('cascade');
            //$table->foreignId('process_id')->change()->constrained('processes')->onDelete('cascade');
        });

        Schema::table('tcps', function(Blueprint $table) {
            $table->dropForeign(['ip_id']);
            $table->foreign("ip_id")->references('id')->on('ips')->onDelete('cascade');
            //$table->foreignId('ip_id')->change()->constrained('ips')->onDelete('cascade');
        });

        Schema::table('udps', function(Blueprint $table) {
            $table->dropForeign(['ip_id']);
            $table->foreign("ip_id")->references('id')->on('ips')->onDelete('cascade');
            //$table->foreignId('ip_id')->change()->constrained('ips')->onDelete('cascade');
        });

        Schema::table('https', function(Blueprint $table) {
            $table->dropForeign(['tcp_id']);
            $table->foreign("tcp_id")->references('id')->on('tcps')->onDelete('cascade');
            //$table->foreignId('tcp_id')->change()->constrained('tcps')->onDelete('cascade');
        });

        Schema::table('tls', function(Blueprint $table) {
            $table->dropForeign(['tcp_id']);
            $table->foreign("tcp_id")->references('id')->on('tcps')->onDelete('cascade');
            //$table->foreignId('tcp_id')->change()->constrained('tcps')->onDelete('cascade');
        });

        Schema::table('dns', function(Blueprint $table) {
            $table->dropForeign(['udp_id']);
            $table->foreign("udp_id")->references('id')->on('udps')->onDelete('cascade');
            //$table->foreignId('udp_id')->change()->constrained('udps')->onDelete('cascade');
        });

        Schema::table('dns_addresses', function(Blueprint $table) {
            $table->dropForeign(['dns_id']);
            $table->foreign("dns_id")->references('id')->on('dns')->onDelete('cascade');
            //$table->foreignId('dns_id')->change()->constrained('dns')->onDelete('cascade');
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
