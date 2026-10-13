<?php

namespace App\Services;

use App\Models\Lease;
use App\Models\Tenants;
use App\Models\Unit;

class LeaseService
{
    public function createForTenant(Tenants $tenant, Unit $unit): array
    {
        $lease = Lease::create([
            'tenant_id' => $tenant->id,
            'unit_id' => $unit->id,
            'start_date' => now()->toDateString(),
            'signed_date' => now()->toDateString(),
            'status' => 'active',
        ]);

        $unit->update(['status' => 'occupied']);

        return [$lease, $tenant, $unit];
    }
}