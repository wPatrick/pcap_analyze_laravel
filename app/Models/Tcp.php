<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tcp
 *
 * @property int $id
 * @property int $ip_id
 * @property string $port_src
 * @property string $port_dst
 *
 * @property Ip $ip
 * @property Collection|Http[] $https
 * @property Collection|Tls[] $tls
 *
 * @package App\Models
 */
class Tcp extends Model
{
	protected $table = 'tcps';
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

	public function https()
	{
		return $this->hasMany(Http::class);
	}

	public function tls()
	{
		return $this->hasMany(Tls::class);
	}
}
