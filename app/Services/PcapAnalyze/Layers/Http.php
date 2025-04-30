<?php

namespace App\Services\PcapAnalyze\Layers;

use JetBrains\PhpStorm\Pure;

class Http
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

    public function getModel(): \App\Models\Http
    {
        return $this->model;
    }

    public function process(): bool {
        if (property_exists($this->layers->getLayers(), "http")) {
            if(property_exists($this->layers->getLayers()->http, "http.host")) {
                $uri = $this->layers->getLayers()->http->{"http.request.full_uri"};
                $this->model = $this->tcp->getModel()->https()->firstOrCreate([
                    "url" => $uri
                ]);
            }
            return true;
        }
        return false;
    }
}
