<?php

namespace App\Http\Resources;

use App\Models\Pcap;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PcapResource extends ResourceCollection
{
    private $pcap;


    public function __construct(Pcap $pcap) {
        parent::__construct($pcap);
        $this->pcap = $pcap;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $media = $this->pcap->getFirstMedia('pcap');

        return [
            'id' => $this->pcap->id,
            'name' => $this->pcap->name,
            'size' => $media?->size,
            'url' => $media?->getTemporaryUrl(now()->addMinutes(60)),
            'analyzed' => $this->pcap->analyzed,
            'updated_at' => $this->pcap->updated_at->format('d.m.y H:m')
        ];
    }
}
