<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\WithUUid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeviceType
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Device[] $devices
 *
 * @package App\Models
 */
class DeviceType extends Model
{
    protected $table = 'device_types';

	protected $fillable = [
		'name'
	];

	public function devices()
	{
		return $this->hasMany(Device::class, 'device_type');
	}

    public function scopeFilter($query, $name) {
        $query->when($name ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
