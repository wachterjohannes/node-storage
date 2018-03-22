<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\EventStore;

interface EventStoreInterface
{
    public function retrieve($argument1);

    public function persist($argument1);

    public function flush();
}
