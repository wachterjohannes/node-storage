<?php

declare(strict_types=1);

namespace spec\Asapo\NodeStorage\AggregateRoot;

use Asapo\NodeStorage\AggregateRoot\AggregateRootInterface;
use Asapo\NodeStorage\AggregateRoot\AggregateRootTrait;
use Asapo\NodeStorage\EventStore\Event;
use PhpSpec\ObjectBehavior;

class AggregateRootTraitSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(AggregateRoot::class);
    }

    public function it_should_apply_all_events_on_reconstitute(
        Event $event1,
        Event $event2
    ) {
        $this->reconstituteFromEvents([$event1, $event2]);

        $this->getAppliedEvents()->shouldBe([$event1, $event2]);
        $this->releaseEvents()->shouldBe([]);
    }

    public function it_should_apply_and_record_event(
        Event $event
    ) {
        $this->recordThat($event);

        $this->getAppliedEvents()->shouldBe([$event]);
        $this->releaseEvents()->shouldBe([$event]);
    }

    public function it_should_reset_recorded_events_on_release(
        Event $event
    ) {
        $this->recordThat($event);

        $this->getAppliedEvents()->shouldBe([$event]);
        $this->releaseEvents()->shouldBe([$event]);

        $this->releaseEvents()->shouldBe([]);
    }
}

class AggregateRoot implements AggregateRootInterface
{
    use AggregateRootTrait {
        recordThat as doRecordThat;
    }

    /**
     * @var Event[]
     */
    private $appliedEvents = [];

    protected function apply(Event $event): void
    {
        $this->appliedEvents[] = $event;
    }

    public function getAppliedEvents(): array
    {
        return $this->appliedEvents;
    }

    public function recordThat(Event $event): void
    {
        $this->doRecordThat($event);
    }
}
