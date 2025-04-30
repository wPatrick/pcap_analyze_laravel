<?php

namespace App\Services\PcapAnalyze\Layers;

use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class Ethernet extends Layers
{
    protected Collection $ethConnections;
    private int|bool $currentEthernetConnection;
    protected Tcp $tcp;
    protected Ip $ip;

    public function process(): bool {
        // check if eth layer is existent otherwise inform user, we are currently only interested in eth connections and skip package
        if(!property_exists($this->getLayers(), "eth")) {
            // echo "eth layer does not exists, whats that shit come from dude?";
            // we dont need eth, nevermind
            return true;
        }

        $eth_devices = ['src' => $this->getLayers()->eth->{"eth.src"}, 'dst' => $this->getLayers()->eth->{"eth.dst"}];

        // Only add connection if not allready exists, get index of current connection for linking purpose
        $this->currentEthernetConnection = $this->ethConnections->search($eth_devices);
        if($this->currentEthernetConnection === false) {
            $this->ethConnections->add($eth_devices);
            $this->currentEthernetConnection = $this->ethConnections->keys()->last();
        }
        return true;
    }

    public function getConnections(): array
    {
        return $this->ethConnections;
    }


}
