<?php

declare(strict_types=1);

namespace spec\Asapo\NodeStorage\CommandBus;

use Asapo\NodeStorage\CommandBus\CommandBus;
use Asapo\NodeStorage\CommandBus\CommandInterface;
use Asapo\NodeStorage\CommandBus\HandlerInterface;
use Asapo\NodeStorage\CommandBus\HandlerLocatorInterface;
use PhpSpec\ObjectBehavior;

class CommandBusSpec extends ObjectBehavior
{
    public function let(
        HandlerLocatorInterface $locator
    ) {
        $this->beConstructedWith($locator);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommandBus::class);
    }

    public function it_should_locate_and_call_handler(
        HandlerLocatorInterface $locator,
        HandlerInterface $handler,
        CommandInterface $command
    ) {
        $locator->locate($command)->willReturn($handler);

        $handler->handle($command)->shouldBeCalled()->willReturn('result');

        $this->handle($command)->shouldBe('result');
    }
}
