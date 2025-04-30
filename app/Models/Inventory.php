<?php

namespace App\Models;

use App\Traits\WithUUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use WithUUid;
    protected $table = "inventory";
    protected $fillable = [ 'id', 'manufacturer_id', 'typ', 'seriennummer', 'geraet', 'eigenschaften', 'emv', 'safety', 'tco', 'ergonomy', 'umwelt', 'qualitaet', 'akkustik', 'emv_pruef', 'safety_pruef', 'tco_pruef', 'ergonomy_pruef', 'umwelt_pruef', 'qualitaet_pruef', 'akkustik_pruef', 'emv_berichtsnummer', 'safety_berichtsnummer', 'tco_berichtsnummer', 'ergonomy_berichtsnummer', 'umwelt_berichtsnummer', 'qualitaet_berichtsnummer', 'akkustik_berichtsnummer', 'rechnunsgsnummer', 'rechnungsdatum', 'rechnunsbetrag', 'wareneingangsdatum', 'angenommen_von', 'spediteur', 'warenausgangsdatum', 'lieferscheinnummer_ausgang', 'lieferscheinnummer_eingang', 'auftragsnummer_kunde', 'emv_ausstellungsdatum', 'safety_ausstellungsdatum', 'tco_ausstellungsdatum', 'ergonomy_ausstellungsdatum', 'umwelt_ausstellungsdatum', 'qualitaet_ausstellungsdatum', 'akkustik_ausstellungsdatum', 'art_bericht', 'art_pruef', 'bericht', 'pruef_ergebnis', 'angebot', 'angebotsbestaetigung', 'rechnung', 'notizen', 'obl_nummer_intern', 'eigenbedarf', 'auftragsbestaetigung' ];
    use HasFactory;
    use SoftDeletes;

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function manufacturer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

   public function scopeFilter($query, array $filters) {
       $query->when($filters['search'] ?? null, function ($query, $search) {
           $query->where('typ', 'like', '%'.$search.'%');
           $query->orWhere('id', 'like', str_ireplace(['obl',' '], '', $search).'%');
           $query->orWhere('typ', 'like', '%'.$search.'%');
           $query->orWhere('seriennummer', 'like', '%'.$search.'%');

       })->when($filters['trashed'] ?? null, function ($query, $trashed) {
           if ($trashed === 'with') {
               $query->withTrashed();
           } elseif ($trashed === 'only') {
               $query->onlyTrashed();
           }
       });

    }
}
