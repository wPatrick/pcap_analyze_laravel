<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Class Device
 *
 * @property int $id
 * @property int $device_meta_id
 * @property int $number
 * @property string $serial
 * @property string $mac
 *
 * @property DeviceMeta $device_meta
 * @property Collection|Process[] $process
 *
 * @package App\Models
 */
class Device extends Model
{
	protected $table = 'devices';
	public $timestamps = false;
    protected $appends = array('letter');

	protected $casts = [
		'device_meta_id' => 'int',
		'number' => 'int'
	];

	protected $fillable = [
		'device_meta_id',
		'number',
		'serial',
		'mac'
	];

    public function getLetterAttribute() {
        $value = $this->number-1;
        $r = '';
        for ($i = 1; $value >= 0 && $i < 10; $i++) {
            $r = chr(0x41 + ($value % pow(26, $i) / pow(26, $i - 1))) . $r;
            $value -= pow(26, $i);
        }
        return $r;
    }

    public function getOblExtAttribute() {
        return $this->device_meta->obl_id.$this->getLetterAttribute();
    }

	public function device_meta()
	{
		return $this->belongsTo(DeviceMeta::class);
	}

	public function process()
    {
		return $this->belongsToMany(Process::class, 'process_devices')
					->withPivot('id', 'obl_ext');
	}

    public function scopeFilter($query, $name) {

        $query->when($name ?? null, function ($query, $search) {
            $query->device_meta()->where('name', 'like', '%' . $search . '%');
        });
    }
}
