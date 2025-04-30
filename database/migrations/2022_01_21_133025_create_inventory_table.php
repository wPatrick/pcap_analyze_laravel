<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers');
            $table->tinyText('typ')->nullable();
            $table->tinyText('seriennummer')->nullable();
            $table->tinyText('geraet')->nullable();
            $table->longText('eigenschaften')->nullable();
            $table->boolean('emv')->nullable();
            $table->boolean('safety')->nullable();
            $table->boolean('tco')->nullable();
            $table->boolean('ergonomy')->nullable();
            $table->boolean('umwelt')->nullable();
            $table->boolean('qualitaet')->nullable();
            $table->boolean('akkustik')->nullable();
            $table->boolean('emv_pruef')->nullable();
            $table->boolean('safety_pruef')->nullable();
            $table->boolean('tco_pruef')->nullable();
            $table->boolean('ergonomy_pruef')->nullable();
            $table->boolean('umwelt_pruef')->nullable();
            $table->boolean('qualitaet_pruef')->nullable();
            $table->boolean('akkustik_pruef')->nullable();
            $table->tinyText('emv_berichtsnummer')->nullable();
            $table->tinyText('safety_berichtsnummer')->nullable();
            $table->tinyText('tco_berichtsnummer')->nullable();
            $table->tinyText('ergonomy_berichtsnummer')->nullable();
            $table->tinyText('umwelt_berichtsnummer')->nullable();
            $table->tinyText('qualitaet_berichtsnummer')->nullable();
            $table->tinyText('akkustik_berichtsnummer')->nullable();
            $table->tinyText('rechnunsgsnummer')->nullable();
            $table->tinyText('rechnungsdatum')->nullable();
            $table->decimal('rechnunsbetrag', 12, 2)->nullable();
            $table->date('wareneingangsdatum')->nullable();
            $table->tinyText('angenommen_von')->nullable();
            $table->tinyText('spediteur')->nullable();
            $table->date('warenausgangsdatum')->nullable();
            $table->tinyText('lieferscheinnummer_ausgang')->nullable();
            $table->tinyText('lieferscheinnummer_eingang')->nullable();
            $table->tinyText('auftragsnummer_kunde')->nullable();
            $table->date('emv_ausstellungsdatum')->nullable();
            $table->date('safety_ausstellungsdatum')->nullable();
            $table->date('tco_ausstellungsdatum')->nullable();
            $table->date('ergonomy_ausstellungsdatum')->nullable();
            $table->date('umwelt_ausstellungsdatum')->nullable();
            $table->date('qualitaet_ausstellungsdatum')->nullable();
            $table->date('akkustik_ausstellungsdatum')->nullable();
            $table->tinyText('art_bericht')->nullable();
            $table->tinyText('art_pruef')->nullable();
            $table->tinyText('bericht')->nullable();
            $table->tinyText('pruef_ergebnis')->nullable();
            $table->text('angebot')->nullable();
            $table->text('angebotsbestaetigung')->nullable();
            $table->text('rechnung')->nullable();
            $table->text('notizen')->nullable();
            $table->tinyText('obl_nummer_intern')->nullable();
            $table->boolean('eigenbedarf')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('inventory');
    }
}
