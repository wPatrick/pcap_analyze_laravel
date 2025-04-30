<?php

namespace App\Services\PcapAnalyze\Layers;

use App\Models\Udps;

class Dns
{
    protected Udp $udp;
    public Layers $layers;
    public $model;

    public function __construct(Udp $udp)
    {
        $this->udp = $udp;
        $this->layers = $udp->layers;
        if($udp->getModel() !== null)
            $this->process();
    }

    public function process() {
        if (property_exists($this->layers->getLayers(), "dns")) {
            $responseFlag = $this->layers->getLayers()->dns->{"dns.flags_tree"}->{"dns.flags.response"};
            // only track answers
            if($responseFlag == "1") {
                if(property_exists($this->layers->getLayers()->dns, "Answers") ) {
                    $name = false;
                    foreach($this->layers->getLayers()->dns->Queries as $dnsRequest) {
                        $name = $dnsRequest->{"dns.qry.name"};
                    }
                    if($name) {
                        foreach ($this->layers->getLayers()->dns->Answers as $dnsAnswer) {
                            $address = false;
                            if ($dnsAnswer->{"dns.resp.type"} == "1") {
                                $address = $dnsAnswer->{"dns.a"};
                            } else if ($dnsAnswer->{"dns.resp.type"} == "28") {
                                $address = $dnsAnswer->{"dns.aaaa"};
                            }
                            if ($address) {
                                /** @var \App\Models\Dns $dns */
                                $dns = $this->udp->getModel()->dns()->firstOrCreate([
                                    "name" => $name
                                ]);
                                $dns->dns_addresses()->firstOrCreate([
                                    "ip" => $address
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
