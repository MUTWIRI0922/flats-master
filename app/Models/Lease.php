<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}
