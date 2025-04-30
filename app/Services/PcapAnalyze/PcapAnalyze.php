<?php
namespace App\Services\PcapAnalyze;

use App\Services\DBIP\APIKey;
use App\Services\DBIP\Address;

use App\Services\PcapAnalyze\Layers\Layers;
use JsonMachine\Exception\InvalidArgumentException;
use App\Services\PcapAnalyze\Layers\Dns;
use App\Services\PcapAnalyze\Layers\Http;
use App\Services\PcapAnalyze\Layers\Ip;
use App\Services\PcapAnalyze\Layers\Tcp;
use App\Services\PcapAnalyze\Layers\Tls;
use App\Services\PcapAnalyze\Layers\Udp;
use JsonMachine\Items;
use GeoIp2\Database\Reader;
use JsonMachine\JsonDecoder\DecodingError;
use JsonMachine\JsonDecoder\ErrorWrappingDecoder;
use JsonMachine\JsonDecoder\ExtJsonDecoder;


class PcapAnalyze
{
    public $pcap_id;
    public $process_id;
    protected Reader $reader;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pcap:import {pcapfile : file path of the pcap json file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import pcap json file';

    /**
     * @var false|mixed
     */

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($pcap_id, $process_id)
    {
        $this->pcap_id = $pcap_id;
        $this->process_id = $process_id;

    }

    public function getAsn($ip) {
        // return $this->reader->asn($ip)->autonomousSystemNumber." ";
        APIKey::set("8b8e09582fe270f618631c19a0b6f3295628b0ae");
        $addrInfo = Address::lookup($ip);
        try {
            return $addrInfo->asNumber." - ".$addrInfo->asName." - ".$addrInfo->isp." (".$addrInfo->city."/".$addrInfo->countryName.")";
        } catch(\Exception $e) {
            return "";
        }
    }

    public function analyze($pcapfile): static
    {
        try {
            $this->packages = Items::fromFile($pcapfile, ['decoder' => new ErrorWrappingDecoder(new ExtJsonDecoder())]);
            $loop = 0;
            $layers = new Layers($this->pcap_id, $this->process_id);

            foreach($this->packages as $key => $this->package) {
                if ($key instanceof DecodingError || $this->package instanceof DecodingError) {
                    // handle error of this malformed json item
                    // dd($this->package->getMalformedJson());#
                    echo "Decoding Error: Pcap: ".$pcapfile."\n";
                    try{
                        $this->package = json_decode($this->utf8ize($this->package->getMalformedJson()));
                    } catch(\Exception $e) {
                        continue;
                    }
                }

                $layers->setLayers($this->package->_source->layers);
                $ip =  new Ip($layers);
                $tcp = new Tcp($ip);
                $tls = new Tls($tcp);
                $http = new Http($tcp);
                $udp = new Udp($ip);
                $dns = new Dns($udp);
                $reader = new Reader(database_path('dbip-asn.mmdb'));

            }

        } catch (InvalidArgumentException $e) {
            echo "Invalid Argument";
        }

        return $this;
    }

    function utf8ize( $mixed ) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = $this->utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }
        return $mixed;
    }
}
