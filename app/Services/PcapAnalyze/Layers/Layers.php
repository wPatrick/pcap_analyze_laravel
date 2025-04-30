<?php

namespace App\Services\PcapAnalyze\Layers;

use GeoIp2\Database\Reader;
use JetBrains\PhpStorm\ArrayShape;

class Layers
{
    public $layers;
    public $pcap_id;
    public $process_id;
    protected Reader $reader;

    public function __construct($pcap_id, $process_id) {
        $this->pcap_id = $pcap_id;
        $this->process_id = $process_id;
        $this->reader = new Reader(database_path('dbip-country.mmdb'));
    }

    public function setLayers($layers) {
        $this->layers = $layers;
    }

    public function getLayers() {
        return $this->layers;
    }

    public function getReader(): Reader
    {
        return $this->reader;
    }




}
