<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\CommandBus;

class CommandBus
{
    /**
     * @var HandlerLocatorInterface
     */
    private $locator;

    public function __construct(HandlerLocatorInterface $locator)
    {
        $this->locator = $locator;
    }

    public function handle(CommandInterface $command)
    {
        return $this->locator->locate($command)->handle($command);
    }
}
