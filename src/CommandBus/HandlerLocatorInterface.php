<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\CommandBus;

interface HandlerLocatorInterface
{
    public function locate(CommandInterface $handler): HandlerInterface;
}
