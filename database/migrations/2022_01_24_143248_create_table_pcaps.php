<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePcaps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcaps', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->tinyText('name');
            $table->foreignId("process_id")->constrained('processes');
            $table->json("ip_connections")->nullable();
            $table->json("eth_connections")->nullable();
            $table->json("tcp")->nullable();
            $table->json("udp")->nullable();
            $table->json("http")->nullable();
            $table->json("tls")->nullable();
            $table->json("dns")->nullable();
            $table->boolean('analyzed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_pcaps');
    }
}
