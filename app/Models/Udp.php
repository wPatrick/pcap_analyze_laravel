<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Udp
 *
 * @property int $id
 * @property int $ip_id
 * @property string $port_src
 * @property string $port_dst
 *
 * @property Ip $ip
 * @property Collection|Dns[] $dns
 *
 * @package App\Models
 */
class Udp extends Model
{
	protected $table = 'udps';
	public $timestamps = false;

	protected $casts = [
		'ip_id' => 'int'
	];

	protected $fillable = [
		'ip_id',
		'port_src',
		'port_dst'
	];

	public function ip()
	{
		return $this->belongsTo(Ip::class);
	}

	public function dns()
	{
		return $this->hasMany(Dns::class);
	}
}
