<?php

namespace App\Http\Controllers;

use App\Exports\ProcessAuswertung;
use App\Http\Resources\PcapResource;
use App\Jobs\ProcessPcaps;
use App\Models\Dns;
use App\Models\Ip;
use App\Models\Pcap;
use App\Models\Process;
use App\Models\Udp;
use App\Services\PcapAnalyze\PcapAnalyze;
use App\Services\PcapAnalyze\ProcessAnalyse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProcessAnalysisController extends Controller
{
    public function show(Process $process)
    {

        $ips = (new ProcessAnalyse($process))->process();

        return Inertia::render('Process/Show',
            [
                'pcaps' => PcapResource::collection(Pcap::where('process_id', $process->id)->get()),
                'process' => $process,
                'ips' => $ips,
            ]
        );
    }

    public function download(Process $process)
    {
        $export = new ProcessAuswertung($process);
        return $export->download('auswertung_'.$process->name."_".$process->inventory->id.".xls");

    }

    public function analyze(Process $process) {
        $pcaps = $process->pcaps;
        $process->pcaps()->update(['analyzed' => false]);
        foreach($pcaps as $pcap) {
            $processPcap = new ProcessPcaps($pcap);
            $this->dispatch($processPcap);
        }
        return Redirect::back()->with('success', 'Analyse gestartet.');
    }

}
