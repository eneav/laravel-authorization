<?php
/**
 * Created on 10/03/18 by enea dhack.
 */

namespace Enea\Authorization\Exceptions;

class UnauthorizedOwnerException extends UnauthorizedException
{
    public function __construct(int $statusCode, array $grantables, array $headers = array())
    {
        parent::__construct($statusCode, $this->makeMessage($grantables), $headers);
    }

    private function makeMessage(array $grantables): string
    {
        return 'owner unauthorized';
    }
}