<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\AggregateRoot;

use Asapo\NodeStorage\EventStore\Event;

interface AggregateRootInterface
{
    /**
     * @param Event[] $events
     */
    public function reconstituteFromEvents(array $events): AggregateRootInterface;

    public function releaseEvents();
}
