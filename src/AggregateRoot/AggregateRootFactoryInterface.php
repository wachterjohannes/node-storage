<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\AggregateRoot;

interface AggregateRootFactoryInterface
{
    public function create(string $aggregateRootId): AggregateRootInterface;
}
