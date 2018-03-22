<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\AggregateRoot;

use Asapo\NodeStorage\EventStore\Event;

trait AggregateRootTrait
{
    /**
     * @var Event[]
     */
    protected $recordedEvents = [];

    protected function recordThat(Event $event): void
    {
        $this->apply($event);

        $this->recordedEvents[] = $event;
    }

    abstract protected function apply(Event $event): void;

    public function reconstituteFromEvents(array $events): AggregateRootInterface
    {
        foreach ($events as $event) {
            $this->apply($event);
        }

        return $this;
    }

    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }
}
