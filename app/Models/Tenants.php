<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Tenants extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

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
