<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'unit_number',
        'rent_amount',
        'unit_class',
        'property_id',
        'status',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function leases()
    {
        return $this->hasMany(Lease::class, 'tenant_id');
    }
}
