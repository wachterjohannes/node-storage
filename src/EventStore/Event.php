<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\EventStore;

use Asapo\NodeStorage\AggregateRoot\AggregateRootId;

class Event
{
    /**
     * @var AggregateRootId
     */
    private $aggregateRootId;

    public function __construct(AggregateRootId $aggregateRootId)
    {
        $this->aggregateRootId = $aggregateRootId;
    }

    public function getAggregateRootId(): AggregateRootId
    {
        return $this->aggregateRootId;
    }
}
