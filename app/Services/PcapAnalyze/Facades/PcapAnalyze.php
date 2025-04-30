<?php

namespace App\Services\PcapAnalyze\Facades;

use Illuminate\Support\Facades\Facade;

class PcapAnalyze extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'pcapanalyze';
    }
}
