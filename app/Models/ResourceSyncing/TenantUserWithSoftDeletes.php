<?php

namespace App\Models\ResourceSyncing;

use Illuminate\Database\Eloquent\SoftDeletes;

class TenantUserWithSoftDeletes extends TenantUser
{
    use SoftDeletes;

    public function getCentralModelName(): string
    {
        return CentralUserWithSoftDeletes::class;
    }
}
