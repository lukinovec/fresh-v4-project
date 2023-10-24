<?php

declare(strict_types=1);

namespace App\Models\ResourceSyncing;

use App\Models\Tenant as BaseTenant;
use Stancl\Tenancy\ResourceSyncing\TenantPivot;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TenaResourceSyncingTenantnt extends BaseTenant
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(CentralUser::class, 'tenant_users', 'tenant_id', 'global_user_id', 'id', 'global_id')
            ->using(TenantPivot::class);
    }

    public function customPivotUsers(): BelongsToMany
    {
        return $this->belongsToMany(CentralUser::class, 'tenant_users', 'tenant_id', 'global_user_id', 'id', 'global_id', 'users')
            ->using(CustomPivot::class);
    }
}
