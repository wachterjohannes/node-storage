<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\AggregateRoot;

use Asapo\NodeStorage\EventStore\EventStoreInterface;

class AggregateRootRepository
{
    /**
     * @var AggregateRootFactoryInterface
     */
    private $factory;

    /**
     * @var EventStoreInterface
     */
    private $eventStore;

    public function __construct(AggregateRootFactoryInterface $factory, EventStoreInterface $eventStore)
    {
        $this->factory = $factory;
        $this->eventStore = $eventStore;
    }

    public function create(string $aggregateRootId): AggregateRootInterface
    {
        return $this->factory->create($aggregateRootId);
    }

    public function retrieve(string $aggregateRootId): AggregateRootInterface
    {
        $events = $this->eventStore->retrieve($aggregateRootId);

        return $this->factory->create($aggregateRootId)->reconstituteFromEvents($events);
    }

    public function persist(AggregateRootInterface $aggregateRoot): void
    {
        $events = $aggregateRoot->releaseEvents();

        foreach ($events as $event) {
            $this->eventStore->persist($event);
        }

        $this->eventStore->flush();
    }
}
