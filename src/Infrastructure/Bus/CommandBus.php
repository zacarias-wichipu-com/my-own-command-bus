<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Middleware\Middleware;


final readonly class CommandBus
{
    public function __construct(
        private CommandHandlerDriver $commandHandlerDriver,
        private Middleware $middleware
    ) {
    }

    public function __invoke(Command $command): void
    {
        ($this->middleware)($command, $this);
    }

    public function handle(Command $command): void
    {
        $handler = $this->commandHandlerDriver->getCommandHandlerFor(command: $command);
        ($handler)(command: $command);
    }
}
