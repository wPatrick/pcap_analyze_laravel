<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPcaps;
use App\Models\Inventory;
use App\Models\Pcap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Exports\PcapExport;

class PcapAnalyzerController extends Controller
{
    public function index()
    {
        return Inertia::render('Pcap/Index',
            [
                'filters' => \Illuminate\Support\Facades\Request::all('search'),
                'pcaps' => Pcap::all()
                    ->transform(fn ($pcap) => [
                            'id' => $pcap->id,
                            'oblid' => $pcap->inventory_id,
                            'name' => $pcap->name,
                            'media' => $pcap->getFirstMedia('pcap') ? $pcap->getFirstMedia('pcap')->getTemporaryUrl(Carbon::now()->addMinutes(15)) : null

                        ])
            ]
        );
    }

    public function store(Request $request) {
        $request->validate([
            'oblid' => 'required'
        ]);

        if($request->hasFile('filelist')) {
            foreach($request->file('filelist') as $file) {
                $pcap = Pcap::create([
                    'inventory_id' => $request->get('oblid'),
                    'name' => $file->getClientOriginalName()
                ]);
                $pcap->addMedia($file)->toMediaCollection('pcap');
            }


        }
        return Redirect::route('pcaps')->with('success', 'Pcap uploaded.');
    }

    public function show($pcapId) {
        return Inertia::render('Pcap/Show', [
            'pcap' => Pcap::find($pcapId)
        ]);
    }

    public function create(Request $request) {
        return Inertia::render('Pcap/Create', [
           'oblids' => $request->has('oblid') ? Inventory::where('id', 'like', $request->get('oblid').'%')->limit(10)->get()->pluck('id') : array()
        ]);
    }

    public function analyze($pcapId) {
        $pcap = Pcap::find($pcapId);
        $processPcap = new ProcessPcaps($pcap);
        $this->dispatch($processPcap);
        return Redirect::back()->with('success', 'Analyse gestartet.');
    }

    public function download($pcapId) {
        $pcap = Pcap::find($pcapId);
        $export = new PcapExport($pcap);
        return $export->download($pcap->name.".xlsx");
    }
}
