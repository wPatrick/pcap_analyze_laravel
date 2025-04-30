<?php

namespace App\Services\PcapAnalyze;

use App\Models\Process;
use App\Services\PcapAnalyze\Layers\Ip;

class ProcessAnalyse
{
    private $layer;
    private $process;
    private $devices;

    public function __construct(Process $process) {
        $this->process = $process;
        $this->devices = $process->devices()->with("ips")->get();
    }

    // check if ip is in device list and return
    public function getIpDevice($ip) {
        return $this->devices->filter(function($device) use ($ip) {
            return $device->ips->where("ip", $ip)->first();
        })->first();
    }

    public function getDeviceName($ip_src_is_device, $ip_dst_is_device) {
        if($ip_src_is_device) {
            return $ip_src_is_device->name;
        } else if($ip_dst_is_device) {
            return $ip_dst_is_device->name;
        } else {
            return "Unbekannt";
        }
    }

    public function dns($ip, $search) {
        $pcap_id = $ip->pcap_id;
        $process_id = $ip->process_id;

        $dns = \DB::table('dns')
            ->join('udps', 'dns.udp_id','=', 'udps.id')
            ->join('ips', 'udps.ip_id', '=', 'ips.id')
            ->join('dns_addresses', 'dns_addresses.dns_id', '=', 'dns.id')
            ->where('ips.pcap_id', $pcap_id)
            ->where('ips.process_id', $process_id)
            ->where('dns_addresses.ip', '=', $search)
            ->select('dns_addresses.ip', 'dns.name')
            ->get();

        if(count($dns)) {
            $dnsArray = [];
            foreach($dns as $item) {
                if(!in_array($item->name, $dnsArray))
                    $dnsArray[] = $item->name;
            }
            return $dnsArray;
        }
        return null;
    }

    public function isUnique($ips, $deviceName, $item): bool
    {
        if(array_key_exists($deviceName, $ips)) {
            $ips = $ips[$deviceName];
            foreach($ips as $ip) {
                if($ip['ip_src'] == $item['ip_src'] && $ip['ip_dst'] == $item['ip_dst'] && $ip['port'] == $item['port'] && $ip['sni'] == $item['sni'])
                    return true;
            }
        }
        return false;
    }



    public function process(): array
    {
        $process = $this->process;

        $devices = $process->devices()->with("ips")->get();

        $processIps = $process->ips()->with("tcps", function($query) {
            $query->with('tls');
            $query->with('https');
        })->with("udps", function($query) {
            $query->with('dns');
        })->orderby('ip_dst')->get();

        $ips = [];

        foreach($processIps as $ip) {
            $ip_src_is_device = $this->getIpDevice($ip->ip_src);
            $ip_dst_is_device = $this->getIpDevice($ip->ip_dst);
            $deviceName = $this->getDeviceName($ip_src_is_device, $ip_dst_is_device);

            // Füge nur ausgehende Verbindungen bei bekannten geräten hinzu
            // bei ausgehenden Verbindungen bei bekannten geräten ignoriere lokale Ziele
            // bei unbekannten Geräten füge alle Verbindungen hinzu
            $item = [];
            if((!$ip_src_is_device && !$ip_dst_is_device) || ($ip_src_is_device && !$ip->ip_dst_is_locale)) {
                $itemIp = [
                    'name' => $ip->pcap_name,
                    'ip_src' => $ip->ip_src,
                    'ip_dst' => $ip->ip_dst,
                    'asn' => $ip->asn,
                    'dns' => $this->dns($ip, $ip->ip_dst) ? $this->dns($ip, $ip->ip_dst) : null,
                    'sni' => null,
                    'port' => null,
                    'protocol' => null,
                    'is_eu' => $ip->is_eu,
                ];

                if(count($ip->tcps)) {
                    foreach ($ip->tcps->unique("port_dst")->toArray() as $tcp) {
                        $itemTcp = $itemIp;
                        $itemTcp["port"] = $tcp['port_dst'];
                        $itemTcp['sni'] = '';
                        $itemTcp['protocol'] = "tcp";
                        if(count($tcp['tls']) > 0) {
                            foreach($tcp['tls'] as $tls) {
                                $itemTls = $itemTcp;
                                $itemTls['sni'] = $tls['sni'];
                                if(!$this->isUnique($ips, $deviceName, $itemTls))
                                    $ips[$deviceName][] = $itemTls;
                            }
                        } else {
                            if(!$this->isUnique($ips, $deviceName, $itemTcp))
                                $ips[$deviceName][] = $itemTcp;
                        }
                    }
                } else if(count($ip->udps)) {
                    foreach ($ip->udps->unique("port_dst")->toArray() as $udp) {
                        $itemUdp = $itemIp;
                        $itemUdp['port'] = $udp['port_dst'];
                        $itemUdp['protocol'] = "udp";
                        if(!$this->isUnique($ips, $deviceName, $itemUdp))
                            $ips[$deviceName][] = $itemUdp;
                    }
                }
            }
        }



        // compare devices
        $deviceComparisons = $process->settings_comparisons()->with('device_a')->with('device_b')->get();
        foreach($deviceComparisons as $deviceComparison) {
            $device_a_name = $deviceComparison->device_a()->first()->name;
            $device_b_name = $deviceComparison->device_b()->first()->name;
            if(array_key_exists($device_a_name, $ips) &&
                array_key_exists($device_b_name, $ips)) {
                $devices_a = $ips[$device_a_name];
                $devices_b = $ips[$device_b_name];
                foreach($devices_a as $akey => $a) {
                    foreach($devices_b as $bkey => $b) {
                        if($a['ip_dst'] == $b['ip_dst'] && $a['port'] == $b['port'] && $a['sni'] == $b['sni']) {
                            $ips[$device_a_name." - ".$device_b_name][] = $b;
                            // remove from $a and $b
                            unset($ips[$device_b_name][$bkey]);
                            unset($ips[$device_a_name][$akey]);
                        }
                    }
                }
            }
        }

        return $ips;
    }


}
