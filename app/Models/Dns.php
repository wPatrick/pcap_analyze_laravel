<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dn
 *
 * @property int $id
 * @property int $udp_id
 * @property string $name
 *
 * @property Udp $udp
 * @property Collection|DnsAddress[] $dns_addresses
 *
 * @package App\Models
 */
class Dns extends Model
{
	protected $table = 'dns';
	public $timestamps = false;

	protected $casts = [
		'udp_id' => 'int'
	];

	protected $fillable = [
		'udp_id',
		'name'
	];

	public function udp()
	{
		return $this->belongsTo(Udp::class);
	}

	public function dns_addresses()
	{
		return $this->hasMany(DnsAddress::class, 'dns_id');
	}
}
