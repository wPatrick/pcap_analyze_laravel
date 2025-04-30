<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class Pcap
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property int $process_id
 * @property bool|null $analyzed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Process $process
 * @property Collection|Ip[] $ips
 *
 * @package App\Models
 */
class Pcap extends Model implements HasMedia
{
    use InteractsWithMedia;

	protected $table = 'pcaps';

	protected $casts = [
		'process_id' => 'int',
		'analyzed' => 'bool'
	];

	protected $fillable = [
		'name',
		'process_id',
		'analyzed'
	];

	public function process()
	{
		return $this->belongsTo(Process::class);
	}

	public function ips()
	{
		return $this->hasMany(Ip::class);
	}

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('pcap');
    }
}
