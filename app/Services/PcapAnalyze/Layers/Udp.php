<?php

namespace App\Services\PcapAnalyze\Layers;

use Whoops\Exception\ErrorException;

class Udp
{
    public Ip $ip;
    public Layers $layers;
    public $model;

    public function __construct(Ip $ip)
    {
        $this->ip = $ip;
        $this->layers = $ip->layers;
        $this->model = null;
        $this->process();
    }

    public function getModel(): \App\Models\Udp|null
    {
        return $this->model;
    }

    public function process()
    {
        if(property_exists($this->layers->getLayers(), "udp")) {
            $udp = $this->layers->getLayers()->udp;
            $srcPort = $udp->{"udp.srcport"};
            $dstPort = $udp->{"udp.dstport"};
            $this->model = $this->ip->getModel()->udps()->firstOrCreate([
                "port_src" => $srcPort,
                'port_dst' => $dstPort
            ]);
        }
    }
}
