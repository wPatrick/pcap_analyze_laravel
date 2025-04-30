<?php

namespace App\Services\PcapAnalyze\Layers;

use JetBrains\PhpStorm\Pure;

class Tls
{
    protected Tcp $tcp;
    public Layers $layers;
    public $model;

    public function __construct(Tcp $tcp)
    {
        $this->tcp = $tcp;
        $this->layers = $tcp->layers;
        if($tcp->getModel() != null)
            $this->process();
    }

    public function getModel(): \App\Models\Tls
    {
        return $this->model;
    }

    public function process(): bool {
        if (property_exists($this->layers->getLayers(), "tls")) {
            try {
                $handshake = $this->layers->getLayers()->tls->{"tls.record"}->{"tls.handshake"};
                // we only observe tls client hello messages
                //if($handshake->{"tls.handshake.type"} == "1") {
                    $sni = null;
                    foreach($handshake as $key => $snie) {
                        if(property_exists($snie, "Server Name Indication extension")) {
                            $sni = $snie->{"Server Name Indication extension"}->{"tls.handshake.extensions_server_name"};
                            break;
                        }
                    }
                    $this->model = $this->tcp->getModel()->tls()->firstOrCreate([
                        "sni" => $sni
                    ]);
                //}
                return true;
            } catch(\Exception $e) {
                // do nothing
            }
        }
        return false;
    }
}
