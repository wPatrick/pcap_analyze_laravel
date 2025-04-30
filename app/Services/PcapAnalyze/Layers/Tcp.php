<?php

namespace App\Services\PcapAnalyze\Layers;

class Tcp {

    public Ip $ip;
    public Layers $layers;
    public $tcp;

    public function __construct(Ip $ip)
    {
        $this->ip = $ip;
        $this->layers = $ip->layers;
        $this->tcp = null;
        $this->process();
    }

    public function getModel(): \App\Models\Tcp|null
    {
        return $this->tcp;
    }

    public function process()
    {
        // Get all TCP Ports
        $ports = collect();
        if(property_exists($this->layers->getLayers(), "tcp")) {
            $portSrc = $this->layers->getLayers()->tcp->{"tcp.srcport"};
            $portDst = $this->layers->getLayers()->tcp->{"tcp.dstport"};
            $this->tcp = $this->ip->getModel()->tcps()->firstOrCreate([
                "port_src" => $portSrc,
                'port_dst' => $portDst
            ]);
        }
    }
}
