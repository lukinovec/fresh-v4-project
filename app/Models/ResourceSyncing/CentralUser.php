<?php

declare(strict_types=1);

namespace App\Models\ResourceSyncing;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\ResourceSyncing\SyncMaster;
use Stancl\Tenancy\ResourceSyncing\TenantPivot;
use Stancl\Tenancy\ResourceSyncing\ResourceSyncing;
use Stancl\Tenancy\Database\Concerns\CentralConnection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CentralUser extends Model implements SyncMaster
{
    use ResourceSyncing, CentralConnection;

    protected $guarded = [];

    public $timestamps = false;

    public $table = 'users';

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'tenant_users', 'global_user_id', 'tenant_id', 'global_id')
            ->using(TenantPivot::class);
    }

    public function getTenantModelName(): string
    {
        return TenantUser::class;
    }

    public function getGlobalIdentifierKey(): string|int
    {
        return $this->getAttribute($this->getGlobalIdentifierKeyName());
    }

    public function getGlobalIdentifierKeyName(): string
    {
        return 'global_id';
    }

    public function getCentralModelName(): string
    {
        return static::class;
    }

    public function getSyncedAttributeNames(): array
    {
        return [
            'global_id',
            'name',
            'password',
            'email',
        ];
    }
}
