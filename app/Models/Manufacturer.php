<?php

namespace App\Models;

use App\Traits\WithUUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use WithUUid;
    use HasFactory;
    protected $fillable = [ 'id', 'uuid', 'name' ];

    public function scopeFilter($query, $name)
    {
        $query->when($name ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
