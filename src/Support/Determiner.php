<?php

declare(strict_types=1);

/**
 * Created on 18/03/18 by enea dhack.
 */

namespace Enea\Authorization\Support;

class Determiner
{
    public static function listenUnauthorizedOwnerEventForLogger(): bool
    {
        return self::get('listeners.unauthorized-owner-logger', true);
    }

    public static function transformSecretNameToKebabCase(): bool
    {
        return self::get('authorizations.transform-secret-name-to-kebab-case', true);
    }

    public static function isEnabledMiddleware(): bool
    {
        return self::get('middleware.enabled', true);
    }

    private static function get(string $key, bool $default = false): bool
    {
        return (bool) config("authorization.{$key}", $default);
    }
}
