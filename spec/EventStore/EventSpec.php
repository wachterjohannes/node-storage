<?php

namespace spec\Asapo\NodeStorage\EventStore;

use Asapo\NodeStorage\AggregateRoot\AggregateRootId;
use Asapo\NodeStorage\EventStore\Event;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    function let(
        AggregateRootId $aggregateRootId
    ) {
        $this->beConstructedWith($aggregateRootId);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Event::class);
    }

    function it_should_return_aggregate_root(
        AggregateRootId $aggregateRootId
    ) {
        $this->getAggregateRootId()->shouldBe($aggregateRootId);
    }
}
