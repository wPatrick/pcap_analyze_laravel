<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcessDeviceComparison
 *
 * @property int $id
 * @property int $process_device_a_id
 * @property int $process_device_b_id
 *
 * @property Process $process
 *
 * @package App\Models
 */
class ProcessDeviceComparison extends Model
{
	protected $table = 'process_device_comparisons';
	public $timestamps = false;

	protected $casts = [
		'process_device_a_id' => 'int',
		'process_device_b_id' => 'int'
	];

	protected $fillable = [
		'process_device_a_id',
		'process_device_b_id'
	];

	public function device_a()
	{
		return $this->belongsTo(Process::class, 'process_device_a_id');
	}

    public function device_b()
    {
        return $this->belongsTo(Process::class, 'process_device_b_id');
    }
}
