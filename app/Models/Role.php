<?php

namespace App\Models;

use Spatie\Permission\Models\Role as OriginalRole;

/**
 * @mixin IdeHelperRole
 */
class Role extends OriginalRole
{
    public string $guard_name = 'web';
}
