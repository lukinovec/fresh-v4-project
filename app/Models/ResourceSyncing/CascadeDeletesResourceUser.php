<?php

namespace App\Models\ResourceSyncing;

class CascadeDeletesResourceUser extends TenantUser
{
    public function getCentralModelName(): string
    {
        return CentralUserWithCascadeDeletes::class;
    }
}
