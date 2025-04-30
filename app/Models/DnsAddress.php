<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DnsAddress
 *
 * @property int $id
 * @property int $dns_id
 * @property string $ip
 *
 * @property Dns $dn
 *
 * @package App\Models
 */
class DnsAddress extends Model
{
	protected $table = 'dns_addresses';
	public $timestamps = false;

	protected $casts = [
		'dns_id' => 'int'
	];

	protected $fillable = [
		'dns_id',
		'ip'
	];

	public function dns()
	{
		return $this->belongsTo(Dns::class, 'dns_id');
	}
}
