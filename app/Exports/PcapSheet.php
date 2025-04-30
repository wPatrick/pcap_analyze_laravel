<?php

namespace App\Exports;

use App\Models\Pcap;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class PcapSheet implements FromArray, WithTitle, ShouldAutoSize
{
    private Pcap $pcap;
    private array $sheet;
    private $ip;
    private String $title;

    public function __construct(Pcap $pcap, $type)
    {
        $this->pcap = $pcap;
        $this->ip = $pcap->ip_connections;
        $this->sheet = array();
        $this->title = "";
        switch($type) {
            case 'ip_connections':
                $this->ip_connections();
                $this->title ="Ip Verbindungen";
                break;
            case 'tcp':
                $this->tcp();
                $this->title = "TCP";
                break;
            case 'udp':
                $this->udp();
                $this->title = "UDP";
                break;
            case 'dns':
                $this->dns();
                $this->title = "DNS";
                break;
            case 'http':
                $this->http();
                $this->title = "HTTP";
                break;
            case 'tls':
                $this->tls();
                $this->title = "TLS";
                break;
        }
    }

    public function tcp() {
        $this->sheet[] = ["IP SRC", "IP DST", "PORT", "Land", "Europa" ];
        foreach($this->pcap->tcp as $tcp) {
            $ip = $this->ip[$tcp["ip"]];
            $this->sheet[] = [ $ip["src"], $ip["dst"], $tcp["port"], $ip["country"], $ip["is_eu"] ];
        }
    }

    public function udp() {
        $this->sheet[] = ["IP SRC", "IP DST", "PORT", "Land", "Europa" ];
        foreach($this->pcap->udp as $udp) {
            $ip = $this->ip[$udp["ip"]];
            $this->sheet[] = [ $ip["src"], $ip["dst"], $udp["dstPort"], $ip["country"], $ip["is_eu"] ];
        }
    }

    public function dns() {
        $this->sheet[] = ["IP Client", "DNS Server", "Addresse", "Host" ];
        foreach($this->pcap->dns as $dns) {
            foreach($dns["address"] as $address) {
                $this->sheet[] = [ $dns["src"], $dns["dst"], $address, $dns["name"]];
            }
        }
    }

    public function http() {
        $this->sheet[] = [ "SRC", "DST", "HOST", "URI", "Land", "Europa" ];
        foreach($this->pcap->http as $http) {
            $ip = $this->ip[$http["ip"]];
            foreach($http["uri"] as $uri) {
                $this->sheet[] = [ $ip["src"], $ip["dst"], $http["host"], $uri, $ip["country"], $ip["is_eu"]];
            }
        }
    }

    public function tls() {
        $this->sheet[] = [ "IP SRC", "IP DST", "PORT", "SNI", "Land", "Europa" ];
        foreach($this->pcap->tls as $tls) {
            $ip = $this->ip[$tls["ip"]];
            $this->sheet[] = [ $ip["src"], $ip["dst"], $tls["port"], $tls["sni"], $ip["country"], $ip["is_eu"]];
        }
    }

    public function ip_connections() {
        $this->sheet[] = [ "IP SRC", "IP DST", "Land", "Europa" ];
        foreach($this->ip as $ip) {
            $this->sheet[] = [ $ip["src"], $ip["dst"], $ip["country"], $ip["is_eu"] ];
        }
    }

    public function array(): array
    {
        return $this->sheet;
    }

    public function title(): string
    {
        return $this->title;
    }

}
