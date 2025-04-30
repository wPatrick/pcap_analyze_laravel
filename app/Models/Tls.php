<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tl
 *
 * @property int $id
 * @property int $tcp_id
 * @property string $sni
 *
 * @property Tcp $tcp
 *
 * @package App\Models
 */
class Tls extends Model
{
	protected $table = 'tls';
	public $timestamps = false;

	protected $casts = [
		'tcp_id' => 'int'
	];

	protected $fillable = [
		'tcp_id',
		'sni'
	];

	public function tcp()
	{
		return $this->belongsTo(Tcp::class);
	}
}
