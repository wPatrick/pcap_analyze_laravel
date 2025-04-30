<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ip
 *
 * @property int $id
 * @property int $pcap_id
 * @property int $process_id
 * @property string $mac_src
 * @property string $mac_dst
 * @property string $ip_src
 * @property string $ip_dst
 * @property bool $is_locale
 * @property bool $is_eu
 * @property string|null $city
 * @property string|null $country
 * @property string|null $asn
 * @property string|null $aso
 *
 * @property Pcap $pcap
 * @property Process $process
 * @property Collection|Tcp[] $tcps
 * @property Collection|Udp[] $udps
 *
 * @package App\Models
 */
class Ip extends Model
{

	protected $table = 'ips';
	public $timestamps = false;

	protected $casts = [
		'pcap_id' => 'int',
		'process_id' => 'int',
		'is_locale' => 'bool',
		'is_eu' => 'bool'
	];

    protected $appends = [ 'pcap_name' ];

	protected $fillable = [
		'pcap_id',
		'process_id',
		'ip_src',
		'ip_dst',
		'ip_src_is_locale',
        'ip_dst_is_locale',
		'is_eu',
		'city',
		'country',
		'asn',
		'aso'
	];

	public function pcap()
	{
		return $this->belongsTo(Pcap::class);
	}

    public function  getPcapNameAttribute(): string
    {
        try{
            return $this->pcap->name;

        } catch(\Exception $e) {
            dd($this);
        }
    }

	public function process()
	{
		return $this->belongsTo(Process::class);
	}

	public function tcps()
	{
		return $this->hasMany(Tcp::class);
	}

	public function udps()
	{
		return $this->hasMany(Udp::class);
	}

}
