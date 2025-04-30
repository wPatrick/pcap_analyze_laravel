<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Process
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $obl_id
 * @property string $stage
 * @property string $stage_text
 *
 * @property Collection|Ip[] $ips
 * @property Collection|Pcap[] $pcaps
 * @property Collection|ProcessDeviceComparison[] $process_device_comparisons
 * @property Collection|Device[] $devices
 * @property Collection|ProcessSetting[] $process_settings
 *
 * @package App\Models
 */
class Process extends Model
{
	protected $table = 'process';

	protected $casts = [
		'obl_id' => 'int'
	];

	protected $fillable = [
		'name',
		'obl_id',
		'stage',
		'stage_text',
        'customer_id',

	];

	public function ips()
	{
		return $this->hasMany(Ip::class);
	}

	public function pcaps()
	{
		return $this->hasMany(Pcap::class);
	}

	public function process_device_comparisons()
	{
		return $this->hasMany(ProcessDeviceComparison::class, 'process_device_b_id');
	}

	public function devices()
	{
		return $this->belongsToMany(Device::class, 'process_devices')->using(ProcessDevice::class)->withPivot('id', 'obl_ext', 'ip');
	}



    public function customer() {
        return $this->belongsTo(Customer::class);
    }

	public function process_settings()
	{
		return $this->hasMany(ProcessSetting::class, 'p_id');
	}
}
