<?php

namespace App\Services\PcapAnalyze\Layers;

use App\Services\DBIP\Address;
use App\Services\DBIP\APIKey;
use GeoIp2\Database\Reader;
use JetBrains\PhpStorm\ArrayShape;


class Ip {
    public Layers $layers;
    private \App\Models\Ip $model;
    protected Reader $reader;

    public function __construct(Layers $layers)
    {
        $this->layers = $layers;
        $this->process();
        $this->reader = new Reader(database_path('dbip-country.mmdb'));
    }

    public function getModel(): \App\Models\Ip
    {
        return $this->model;
    }

    public function process() {
        $ip_version = false;

        if(property_exists($this->layers->getLayers(), 'ipv6')) {
            $ip_version = "ipv6";
        }
        else if(property_exists($this->layers->getLayers(), 'ip')){
            $ip_version = "ip";
        }

        if($ip_version) {
            $currentIpSrc = $this->layers->getLayers()->{$ip_version}->{$ip_version.".src"};
            $currentIpDst = $this->layers->getLayers()->{$ip_version}->{$ip_version.".dst"};
            $ipSrcIsLocale = !filter_var($currentIpSrc, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
            $ipDstIsLocale = !filter_var($currentIpDst, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
            try {
                $reader = new Reader(database_path('dbip-country.mmdb'));
                $record = $reader->country($currentIpDst);
                $country = $record->country->isoCode;
                $is_eu = $record->country->isInEuropeanUnion;
            } catch(\Exception $e) {
                $country = '';
                $is_eu = false;
            }

            // we only save ip pairings
            $this->model = \App\Models\Ip::firstOrCreate([
                'ip_src' => $currentIpSrc,
                'ip_dst' => $currentIpDst,
                'pcap_id' => $this->layers->pcap_id,
                'process_id' => $this->layers->process_id,
            ],
            [
                'ip_src' => $currentIpSrc,
                'ip_dst' => $currentIpDst,
                'ip_src_is_locale' => $ipSrcIsLocale,
                'ip_dst_is_locale' => $ipDstIsLocale,
                'is_eu' => $is_eu,
                'city' => '',
                'country' => $country,
                'asn' => '',
                'aso' => '',
            ]);

            if($this->model->wasRecentlyCreated) {
                APIKey::set("8b8e09582fe270f618631c19a0b6f3295628b0ae");
                $addrInfo = Address::lookup($currentIpDst);
                try {
                    $asn = $addrInfo->asNumber." - ".$addrInfo->asName." - ".$addrInfo->isp." (".$addrInfo->city."/".$addrInfo->countryName.")";
                    $this->model->asn = $asn;
                    $this->model->city = $addrInfo->city;
                    $this->model->save();
                }catch(\Exception $e) { }
            }
        }
    }
}
