<?php

declare(strict_types=1);

namespace Asapo\NodeStorage\CommandBus;

interface HandlerInterface
{
    public function handle(CommandInterface $command);
}
