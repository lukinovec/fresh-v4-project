<?php

namespace App\Models\ResourceSyncing;

use Illuminate\Database\Eloquent\SoftDeletes;

class CentralUserWithSoftDeletes extends CentralUser
{
    use SoftDeletes;

    public function getTenantModelName(): string
    {
        return TenantUserWithSoftDeletes::class;
    }
}
