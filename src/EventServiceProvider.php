<?php

declare(strict_types=1);

/**
 * Created on 10/03/18 by enea dhack.
 */

namespace Enea\Authorization;

use Enea\Authorization\Events\UnauthorizedOwner;
use Enea\Authorization\Listeners\WriteUnauthorizedLog;
use Enea\Authorization\Support\Determiner;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function listens()
    {
        return [
            UnauthorizedOwner::class => $this->getUnauthorizedOwnerListeners(),
        ];
    }

    private function getUnauthorizedOwnerListeners(): array
    {
        $listeners = array();

        if (Determiner::listenUnauthorizedOwnerEventForLogger()) {
            $listeners[] = WriteUnauthorizedLog::class;
        }

        return $listeners;
    }
}
