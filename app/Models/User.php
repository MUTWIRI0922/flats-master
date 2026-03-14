<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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
    public function tenants()
    {
        return $this->hasMany(User::class, 'owner_id');
    }
    
    public function properties()
    {
        return $this->hasMany(Property::class, 'owner_id');
    }

}
