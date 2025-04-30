<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProcessDevice extends Pivot
{
    protected $table = 'process_devices';

    protected $casts = [
        'process_id' => 'int',
        'ip' => 'array'
    ];

    protected $fillable = [
        'process_id',
        'ip',
        'obl_ext',
        'device_id'
    ];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function hasIp($ip): bool
    {
        foreach($this->ips as $deviceIp) {
            if($ip == $deviceIp->ip) return true;
        }
        return false;
    }
}
