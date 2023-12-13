<?php

declare(strict_types=1);

namespace App;

use App\Application\Command;

final readonly class CommandBus
{
    public function __construct(
        private HandlerDriver $commandHandlerDriver
    ) {
    }

    public function __invoke(Command $command): void
    {
        $handler = $this->commandHandlerDriver->getCommandHandlerFor(command: $command);
        ($handler)(command: $command);
    }
}
