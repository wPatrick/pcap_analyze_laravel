<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Http
 * 
 * @property int $id
 * @property int $tcp_id
 * @property string $url
 * 
 * @property Tcp $tcp
 *
 * @package App\Models
 */
class Http extends Model
{
	protected $table = 'https';
	public $timestamps = false;

	protected $casts = [
		'tcp_id' => 'int'
	];

	protected $fillable = [
		'tcp_id',
		'url'
	];

	public function tcp()
	{
		return $this->belongsTo(Tcp::class);
	}
}
