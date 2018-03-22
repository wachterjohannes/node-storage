<?php

namespace spec\Asapo\NodeStorage\AggregateRoot;

use Asapo\NodeStorage\AggregateRoot\AggregateRootId;
use PhpSpec\ObjectBehavior;

class AggregateRootIdSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('123-123-123');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AggregateRootId::class);
    }

    function it_should_return_string_value()
    {
        $this->__toString()->shouldBe('123-123-123');
    }
}
