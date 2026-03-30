<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'name',
        'location',
        'amenities',
        'status',
        'owner_id',
    ];

    public function units()
    {
        return $this->hasMany(Unit::class, 'property_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
