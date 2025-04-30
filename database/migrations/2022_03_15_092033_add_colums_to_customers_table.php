<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('short_name');
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('street')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('short_name');
            $table->dropColumn('city');
            $table->dropColumn('zip');
            $table->dropColumn('street');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('description');
        });
    }
}
