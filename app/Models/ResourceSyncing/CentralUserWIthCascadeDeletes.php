<?php

namespace App\Models\ResourceSyncing;

use Stancl\Tenancy\ResourceSyncing\CascadeDeletes;

class CentralUserWithCascadeDeletes extends CentralUser implements CascadeDeletes
{
    public function getTenantModelName(): string
    {
        return CascadeDeletesResourceUser::class;
    }
}
