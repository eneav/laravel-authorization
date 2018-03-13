<?php
/**
 * Created on 10/03/18 by enea dhack.
 */

namespace Enea\Authorization\Middleware;

use Closure;
use Enea\Authorization\Authorizer;
use Enea\Authorization\Contracts\GrantableOwner;
use Enea\Authorization\Events\UnauthorizedOwner;
use Enea\Authorization\Exceptions\UnauthorizedOwnerException;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;

abstract class AuthorizerMiddleware
{
    protected $authorizer;

    private $event;

    public function __construct(Authorizer $authorizer, Dispatcher $event)
    {
        $this->authorizer = $authorizer;
        $this->event = $event;
    }

    abstract protected function authorized(GrantableOwner $owner, array $grantables): bool;

    public function handle(Request $request, Closure $next, string ...$grantables): mixed
    {
        if ($this->isAuthorizedRequestFor($request)($grantables)) {
            return $next($request);
        }

        $this->event->dispatch(new UnauthorizedOwner($request->user(), $grantables));
        throw new UnauthorizedOwnerException(403, $grantables);
    }

    private function isAuthorizedRequestFor(Request $request): Closure
    {
        return function (array $grantables) use ($request): bool {
            $user = $request->user();
            return $user instanceof GrantableOwner && $this->authorized($user, $grantables);
        };
    }
}
