<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\AggregateRoot;

use Asapo\NodeStorage\EventStore\Event;

interface AggregateRootInterface
{
    /**
     * @return Event[]
     */
    public function releaseEvents(): array;

    /**
     * @param Event[] $events
     */
    public function reconstituteFromEvents(array $events): AggregateRootInterface;
}
