<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeviceMeta
 *
 * @property int $id
 * @property int $manufacturer_id
 * @property int $device_type_id
 * @property string $name
 * @property int $obl_id
 * @property int $quantity
 * @property Carbon|null $date_of_receipt
 * @property Carbon|null $date_of_issue
 * @property string|null $typ
 * @property string|null $misc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property DeviceType $device_type
 * @property Manufacturer $manufacturer
 * @property Collection|Device[] $devices
 *
 * @package App\Models
 */
class DeviceMeta extends Model
{
	protected $table = 'device_metas';

	protected $casts = [
		'manufacturer_id' => 'int',
		'device_type_id' => 'int',
		'obl_id' => 'int',
		'quantity' => 'int'
	];

	protected $dates = [
		'date_of_receipt',
		'date_of_issue'
	];

	protected $fillable = [
		'manufacturer_id',
		'device_type_id',
		'name',
		'obl_id',
		'quantity',
		'date_of_receipt',
		'date_of_issue',
		'typ',
		'misc'
	];

	public function device_type()
	{
		return $this->belongsTo(DeviceType::class);
	}

	public function manufacturer()
	{
		return $this->belongsTo(Manufacturer::class);
	}

	public function devices()
	{
		return $this->hasMany(Device::class);
	}

    public function scopeFilter($query, $name) {
        $query->when($name ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('');
        });
    }
}
