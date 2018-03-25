<?php

declare(strict_types=1);

/**
 * Created on 11/02/18 by enea dhack.
 */

namespace Enea\Authorization\Contracts;

interface Authorizable extends RolesOwner, PermissionsOwner, Integrable, Permissible
{
    public function grant(Grantable $grantable): void;

    public function grantMultiple(array $grantables): void;

    public function revoke(Grantable $grantable): void;

    public function revokeMultiple(array $grantables): void;
}
