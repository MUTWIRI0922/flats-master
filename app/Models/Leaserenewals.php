<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaserenewals extends Model
{
    //
    protected $fillable = [
        'lease_id',
        'amount_paid',
        'renewal_date',
        'new_end_date',
        'receipt_number',
    ];
    public function lease()
    {
        return $this->belongsTo(Lease::class, 'lease_id');
    }
}
