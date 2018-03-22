<?php

namespace Asapo\NodeStorage\AggregateRoot;

class AggregateRootId
{
    /**
     * @var string
     */
    private $aggregateRootId;

    public function __construct(string $aggregateRootId)
    {
        $this->aggregateRootId = $aggregateRootId;
    }

    public function __toString()
    {
        return $this->aggregateRootId;
    }
}
