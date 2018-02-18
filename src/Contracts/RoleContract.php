<?php
/**
 * Created on 11/02/18 by enea dhack.
 */

namespace Enea\Authorization\Contracts;

use Illuminate\Support\Collection;

interface RoleContract extends Grantable, Permissible, PermissionOwner
{
    public static function locateByName(string $secretName): ? RoleContract;

    public function attach(PermissionContract $permission): bool;

    public function detach(PermissionContract $permission): bool;

    public function syncAttach(Collection $permissions): void;

    public function syncDetach(Collection $permissions): void;
}
