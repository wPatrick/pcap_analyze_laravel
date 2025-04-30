<?php

namespace App\Exports;

use App\Models\Pcap;
use App\Models\Process;
use App\Models\ProcessDevice;
use App\Services\PcapAnalyze\ProcessAnalyse;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Services\PcapAnalyze\Facades\Asn;
use App\Services\PcapAnalyze\Facades\PcapAnalyze;

class ProcessAuswertung implements WithMultipleSheets, ShouldAutoSize
{
    use Exportable;
    private array $ips;
    private \Illuminate\Support\Collection $connections;
    private \Illuminate\Support\Collection $unknownConnections;
    private \Illuminate\Support\Collection $dns;

   public function __construct(Process $process)
    {
        $this->ips = (new ProcessAnalyse($process))->process();
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = array();
        foreach($this->ips as $key => $device) {
            if(count($device)>0) {
                array_unshift($device, array_keys($device[key($device)]));
            }
            $sheets[] = new ProcessAuswertungSheet($device, $key);
        }
        return $sheets;
    }


}



