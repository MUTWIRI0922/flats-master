<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\FalseType;

class Lease extends Model
{
    //
    protected $fillable = [
        'unit_id',
        'tenant_id',
        'start_date',
        'signed_date',
        'end_date',
        'status',
    ];
    public $timestamps = false;
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }
}
