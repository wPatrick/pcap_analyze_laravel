<?php

namespace App\Console\Commands;

use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class importInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:inventory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*$csv = array_map(function($item) {
            return str_getcsv($item, ",");
        } , file(storage_path('app/dumps/inventory.csv')));*/

        // use fgetcsv to detect weird carriage returns within cell values
        $handle = fopen(storage_path('dumps/inventory1.csv'),'r');
        $csv = array();
        while ( ($data = fgetcsv($handle, null, ";") ) !== FALSE ) {
            $csv[] = $data;
        }

        foreach($csv as $index => $item) {

            if($index === 0) continue; // skip first line
            echo "Line: ".$index."\n";
            $k = 1;
            Inventory::create(
                [
                    'id' => $this->getCsvColumn($item, "id"),
                    'manufacturer_id' => $this->getCsvColumn($item, "manufacturer_id") ?: null,
                    'typ' => $this->getCsvColumn($item, "typ") ?: null,
                    'seriennummer' => $this->getCsvColumn($item, "seriennummer") ?: null,
                    'geraet' => $this->getCsvColumn($item, "geraet") ?: null,
                    'eigenschaften' => $this->getCsvColumn($item, "eigenschaften") ?: null,
                    'emv' => $this->getCsvColumn($item, "emv") ?: null,
                    'safety' => $this->getCsvColumn($item, "safety") ?: null,
                    'tco' => $this->getCsvColumn($item, "tco") ?: null,
                    'ergonomy' => $this->getCsvColumn($item, "ergonomy") ?: null,
                    'umwelt' => $this->getCsvColumn($item, "umwelt") ?: null,
                    'qualitaet' => $this->getCsvColumn($item, "qualitaet") ?: null,
                    'akkustik' => $this->getCsvColumn($item, "akkustik") ?: null,
                    'emv_pruef' => $this->getCsvColumn($item, "emv_pruef"),
                    'safety_pruef' => $this->getCsvColumn($item, "safety_pruef"),
                    'tco_pruef' => $this->getCsvColumn($item, "tco_pruef"),
                    'ergonomy_pruef' => $this->getCsvColumn($item, "ergonomy_pruef"),
                    'umwelt_pruef' => $this->getCsvColumn($item, "umwelt_pruef"),
                    'qualitaet_pruef' => $this->getCsvColumn($item, "qualitaet_pruef"),
                    'akkustik_pruef' => $this->getCsvColumn($item, "akkustik_pruef"),
                    'emv_berichtsnummer' => $this->getCsvColumn($item, "emv_berichtsnummer") ?: null,
                    'safety_berichtsnummer' => $this->getCsvColumn($item, "safety_berichtsnummer") ?: null,
                    'tco_berichtsnummer' => $this->getCsvColumn($item, "tco_berichtsnummer") ?: null,
                    'ergonomy_berichtsnummer' => $this->getCsvColumn($item, "ergonomy_berichtsnummer") ?: null,
                    'umwelt_berichtsnummer' => $this->getCsvColumn($item, "umwelt_berichtsnummer") ?: null,
                    'qualitaet_berichtsnummer' => $this->getCsvColumn($item, "qualitaet_berichtsnummer") ?: null,
                    'akkustik_berichtsnummer' => $this->getCsvColumn($item, "akkustik_berichtsnummer") ?: null,
                    'rechnunsgsnummer' => $this->getCsvColumn($item, "rechnunsgsnummer") ?: null,
                    'rechnungsdatum' => $this->getCsvColumn($item, "rechnungsdatum") ?: null,
                    'rechnunsbetrag' => $this->getCsvColumn($item, "rechnunsbetrag") ?: null,
                    'wareneingangsdatum' =>  $this->getCsvColumn($item, "wareneingangsdatum") ?: null,
                    'angenommen_von' => $this->getCsvColumn($item, "angenommen_von") ?: null,
                    'spediteur' => $this->getCsvColumn($item, "spediteur") ?: null,
                    'warenausgangsdatum' => $this->getCsvColumn($item, "warenausgangsdatum") ?: null,
                    'lieferscheinnummer_ausgang' => $this->getCsvColumn($item, "lieferscheinnummer_ausgang") ?: null,
                    'lieferscheinnummer_eingang' => $this->getCsvColumn($item, "lieferscheinnummer_eingang") ?: null,
                    'auftragsnummer_kunde' => $this->getCsvColumn($item, "auftragsnummer_kunde") ?: null,
                    'emv_ausstellungsdatum' => $this->getCsvColumn($item, "emv_ausstellungsdatum") ?: null,
                    'safety_ausstellungsdatum' => $this->getCsvColumn($item, "safety_ausstellungsdatum") ?: null,
                    'tco_ausstellungsdatum' => $this->getCsvColumn($item, "tco_ausstellungsdatum") ?: null,
                    'ergonomy_ausstellungsdatum' => $this->getCsvColumn($item, "ergonomy_ausstellungsdatum") ?: null,
                    'umwelt_ausstellungsdatum' => $this->getCsvColumn($item, "umwelt_ausstellungsdatum") ?: null,
                    'qualitaet_ausstellungsdatum' => $this->getCsvColumn($item, "qualitaet_ausstellungsdatum") ?: null,
                    'akkustik_ausstellungsdatum' => $this->getCsvColumn($item, "akkustik_ausstellungsdatum") ?: null,
                    'art_bericht' => $this->getCsvColumn($item, "art_bericht") ?: null,
                    'art_pruef' => $this->getCsvColumn($item, "art_pruef") ?: null,
                    'bericht' => $this->getCsvColumn($item, "bericht") ?: null,
                    'pruef_ergebnis' => $this->getCsvColumn($item, "pruef_ergebnis") ?: null,
                    'angebot' => $this->getCsvColumn($item, "angebot") ?: null,
                    'angebotsbestaetigung' => $this->getCsvColumn($item, "angebotsbestaetigung") ?: null,
                    'rechnung' => $this->getCsvColumn($item, "rechnung") ?: null,
                    'notizen' => $this->getCsvColumn($item, "notizen") ?: null,
                    'obl_nummer_intern' => $this->getCsvColumn($item, "obl_nummer_intern") ?: null,
                    'eigenbedarf' => $this->getCsvColumn($item, "eigenbedarf") ?: null,
                ]
            );
        }

        return 0;
    }

    public function return_date($date) {
        if(Carbon::canBeCreatedFromFormat($date, "d.m.Y")) {
            return Carbon::createFromFormat("d.m.Y", $date)->toDateString();
        }
        return false;
    }

    public function getCsvColumn($row, $column) {
        switch ($column)   {
            case 'id': return $row[0]; break;
            case 'manufacturer_id':  return $row[1]; break;
            case 'typ': return $row[2]; break;
            case 'seriennummer': return $row[3]; break;
            case 'geraet': return $row[4]; break;
            case 'eigenschaften': return $row[5]; break;
            case 'emv': return $row[6]; break;
            case 'safety': return $row[7]; break;
            case 'tco': return $row[8]; break;
            case 'ergonomy': return $row[9]; break;
            case 'umwelt': return $row[10]; break;
            case 'qualitaet': return $row[11]; break;
            case 'akkustik': return $row[12]; break;
            case 'emv_pruef': return $row[13] ? 1 : ($row[21] ? 0 : null); break;
            case 'ergonomy_pruef': return $row[14] ? 1 : ($row[23] ? 0 : null); break;
            case 'safety_pruef': return $row[15] ? 1 : ($row[22] ? 0 : null); break;
            case 'akkustik_pruef': return $row[16] ? 1 : ($row[26] ? 0 : null); break;
            case 'umwelt_pruef': return $row[17] ? 1 : ($row[24] ? 0 : null); break;
            case 'qualitaet_pruef': return $row[18] ? 1 : ($row[25] ? 0 : null); break;
            case 'tco_pruef': return $row[19] ? 1 : ($row[20] ? 0 : null); break;
            case 'emv_berichtsnummer': return $row[27]; break;
            case 'safety_berichtsnummer': return $row[28]; break;
            case 'tco_berichtsnummer': return $row[29]; break;
            case 'ergonomy_berichtsnummer': return $row[30]; break;
            case 'umwelt_berichtsnummer': return $row[31]; break;
            case 'akkustik_berichtsnummer': return $row[32]; break;
            case 'qualitaet_berichtsnummer': return $row[33]; break;
            case 'rechnunsgsnummer': return $row[34]; break;
            case 'rechnungsdatum': return $row[35]; break;
            case 'rechnunsbetrag': return str_replace(",", ".", str_replace(".", "", $row[36] )); break;
            case 'wareneingangsdatum': $this->return_date($row[37]); break;
            case 'angenommen_von': return $row[38]; break;
            case 'spediteur': return $row[39]; break;
            case 'warenausgangsdatum': return $this->return_date($row[40]);  break;
            case 'lieferscheinnummer_ausgang': return $row[41]; break;
            case 'lieferscheinnummer_eingang': return $row[42]; break;
            case 'auftragsnummer_kunde': return $row[43]; break;
            case 'emv_ausstellungsdatum': return $this->return_date($row[44]); break;
            case 'safety_ausstellungsdatum': return $this->return_date($row[45]); break;
            case 'ergonomy_ausstellungsdatum': return $this->return_date($row[46]); break;
            case 'umwelt_ausstellungsdatum': return $this->return_date($row[47]); break;
            case 'akkustik_ausstellungsdatum': return $this->return_date($row[48]); break;
            case 'tco_ausstellungsdatum': return $this->return_date($row[49]); break;
            case 'qualitaet_ausstellungsdatum': return $this->return_date($row[50]); break;
            case 'art_bericht': return $row[51]; break;
            case 'art_pruef': return $row[52]; break;
            case 'bericht': return $row[53]; break;
            case 'pruef_ergebnis': return $row[54]; break;
            case 'angebot': return $row[55]; break;
            case 'angebotsbestaetigung': return $row[56]; break;
            case 'auftragsbestaetigung': return $row[57]; break;
            case 'rechnung': return $row[58]; break;
            case 'notizen': return $row[59]; break;
            case 'obl_nummer_intern': return $row[60]; break;
            case 'eigenbedarf': return $row[61]; break;
        }
        return false;
    }
}
