<?php

namespace App\Jobs;

use App\Events\PcapAnalyzed;
use App\Models\Pcap;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\PcapAnalyze\PcapAnalyze;

class ProcessPcaps implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Pcap $pcap;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pcap $pcap)
    {
        $this->pcap = $pcap;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Download file into local tmp folder
        $foo = $this->pcap->getFirstMedia('pcap')->getTemporaryUrl(Carbon::now()->addMinutes(5));
        $temp_file = tempnam(sys_get_temp_dir(), 'Tux');
        $json_file = $temp_file.".json";
        file_put_contents($temp_file, file_get_contents($foo));

        exec('tshark -r '.$temp_file." -T json > ".$json_file);
        $analyze = new PcapAnalyze($this->pcap->id, $this->pcap->process_id);
        $analyze->analyze($json_file);
        $this->pcap->analyzed = true;
        $this->pcap->save();
        unlink($temp_file);
        unlink($json_file);

        // dd($this->pcap->ip_connections);
        PcapAnalyzed::dispatch($this->pcap);

    }
}
