<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'owner_id',
        'password',
    ];    

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function leases()
    {
        return $this->hasMany(Lease::class, 'tenant_id');
    }
}
