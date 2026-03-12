<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenancerequests extends Model
{
    //
    protected $fillable = [
        'lease_id',
        'owner_id',
        'title',
        'description',
        'status',
        'sent_at',
        'resolved_at',
    ];
    public function lease()
    {
        return $this->belongsTo(Lease::class, 'lease_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
