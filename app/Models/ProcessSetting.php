<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Class ProcessSetting
 *
 * @property int $id
 * @property int $p_id
 * @property string $name
 * @property string $value
 *
 * @property Process $process
 *
 * @package App\Models
 */
class ProcessSetting extends Model
{
	protected $table = 'process_settings';
	public $timestamps = false;

	protected $casts = [
		'p_id' => 'int',
        'value' => 'array'
	];

	protected $fillable = [
		'p_id',
		'name',
		'value'
	];

	public function process()
	{
		return $this->belongsTo(Process::class, 'p_id');
	}

}
