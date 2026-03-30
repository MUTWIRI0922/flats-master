<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscriptionrenewals extends Model
{
    //
    protected $fillable = [
        'subscription_id',
        'renewal_date',
    ];
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
}
