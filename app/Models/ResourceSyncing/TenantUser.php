<?php

declare(strict_types=1);

namespace App\Models\ResourceSyncing;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\ResourceSyncing\ResourceSyncing;
use Stancl\Tenancy\ResourceSyncing\Syncable;

class TenantUser extends Model implements Syncable
{
    use ResourceSyncing;

    protected $table = 'users';

    protected $guarded = [];

    public $timestamps = false;

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
        return CentralUser::class;
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
