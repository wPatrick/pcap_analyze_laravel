<?php

namespace OblInsi\PcapAnalyze;

use GeoIp2\Database\Reader;
class Asn
{
    protected Reader $reader;

    public function __construct()
    {
        $this->reader = new Reader(__DIR__.'/../../database/dbip-asn.mmdb');
    }

    public function getAsn($ip) {
        return 1123;
        // $record = $this->reader->country($ip_connection["dst"]);

    }
}
