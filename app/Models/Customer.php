<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\WithUUid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $short_name
 * @property string|null $city
 * @property string|null $zip
 * @property string|null $street
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $description
 *
 * @package App\Models
 */
class Customer extends Model
{
    use WithUUid;
	use SoftDeletes;
	protected $table = 'customers';

	protected $fillable = [
		'uuid',
		'name',
		'short_name',
		'city',
		'zip',
		'street',
		'phone',
		'email',
		'description'
	];

    public function scopeFilter($query, $name)
    {
        $query->when($name ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
