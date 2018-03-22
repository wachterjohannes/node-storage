<?php

namespace spec\Asapo\NodeStorage\EventStore;

use Asapo\NodeStorage\AggregateRoot\AggregateRootId;
use Asapo\NodeStorage\EventStore\Event;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    public function let(
        AggregateRootId $aggregateRootId
    ) {
        $this->beConstructedWith($aggregateRootId);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Event::class);
    }

    public function it_should_return_aggregate_root(
        AggregateRootId $aggregateRootId
    ) {
        $this->getAggregateRootId()->shouldBe($aggregateRootId);
    }
}
