<?php

namespace spec\Asapo\NodeStorage\AggregateRoot;

use Asapo\NodeStorage\AggregateRoot\AggregateRootFactoryInterface;
use Asapo\NodeStorage\AggregateRoot\AggregateRootId;
use Asapo\NodeStorage\AggregateRoot\AggregateRootInterface;
use Asapo\NodeStorage\AggregateRoot\AggregateRootRepository;
use Asapo\NodeStorage\EventStore\Event;
use Asapo\NodeStorage\EventStore\EventStoreInterface;
use PhpSpec\ObjectBehavior;

class AggregateRootRepositorySpec extends ObjectBehavior
{
    public function let(
        AggregateRootFactoryInterface $factory,
        EventStoreInterface $eventStore,
        AggregateRootId $aggregateRootId
    ) {
        $aggregateRootId->__toString()->willReturn('123-123-123');

        $this->beConstructedWith($factory, $eventStore);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(AggregateRootRepository::class);
    }

    public function it_should_use_factory_to_create_instance(
        AggregateRootFactoryInterface $factory,
        AggregateRootInterface $object,
        AggregateRootId $aggregateRootId
    ) {
        $factory->create($aggregateRootId)->shouldBeCalled()->willReturn($object);

        $this->create($aggregateRootId)->shouldBe($object);
    }

    public function it_should_reapply_previous_events_on_retrieve(
        AggregateRootFactoryInterface $factory,
        EventStoreInterface $eventStore,
        AggregateRootInterface $object,
        Event $event1,
        Event $event2,
        AggregateRootId $aggregateRootId
    ) {
        $factory->create($aggregateRootId)->shouldBeCalled()->willReturn($object);

        $events = [$event1, $event2];
        $eventStore->retrieve($aggregateRootId)->willReturn($events);
        $object->reconstituteFromEvents($events)->willReturn($object);

        $this->retrieve($aggregateRootId)->shouldBe($object);
    }

    public function it_should_persist_all_events_on_new_aggregate_roots(
        EventStoreInterface $eventStore,
        AggregateRootInterface $object,
        Event $event1,
        Event $event2
    ) {
        $events = [$event1, $event2];
        $object->releaseEvents()->willReturn($events);

        $eventStore->persist($event1)->shouldBeCalled();
        $eventStore->persist($event2)->shouldBeCalled();

        $eventStore->flush()->shouldBeCalled();

        $this->persist($object);
    }
}
