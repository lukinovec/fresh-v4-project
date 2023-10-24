<?php

namespace App\Models;

use Stancl\Tenancy\Contracts\SingleDomainTenant;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Contracts\TenantWithDatabase;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    // public function getCustomColumns(): array
    // {
    //     return [
    //         'id',
    //         'domain',
    //         'created_at',
    //         'updated_at',
    //     ];
    // }
}
