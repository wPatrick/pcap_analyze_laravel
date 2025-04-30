<?php
namespace App\Exports;

use App\Models\Pcap;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PcapExport implements WithMultipleSheets, ShouldAutoSize
{
    use Exportable;
    private Pcap $pcap;

    public function __construct(Pcap $pcap)
    {
        $this->pcap = $pcap;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets[] = new PcapSheet($this->pcap, "tcp");
        $sheets[] = new PcapSheet($this->pcap, "udp");
        $sheets[] = new PcapSheet($this->pcap, "ip_connections");
        $sheets[] = new PcapSheet($this->pcap, "dns");
        $sheets[] = new PcapSheet($this->pcap, "http");
        $sheets[] = new PcapSheet($this->pcap, "tls");
        return $sheets;
    }
}
