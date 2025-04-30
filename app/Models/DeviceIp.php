<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeviceIp
 *
 * @property int $id
 * @property int $device_id
 * @property string $ip
 *
 * @property ProcessDevice $process_device
 *
 * @package App\Models
 */
class DeviceIp extends Model
{
	protected $table = 'device_ips';
	public $timestamps = false;

	protected $casts = [
		'device_id' => 'int'
	];

	protected $fillable = [
		'device_id',
		'ip'
	];

	public function device()
	{
		return $this->belongsTo(ProcessDevice::class, 'device_id');
	}
}
