<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Message\HandlerBus;
use App\Domain\Message\Command;
use App\Domain\Message\DomainEvent;
use App\Infrastructure\Middleware\Middleware;


final readonly class CommandBus implements HandlerBus
{
    public function __construct(
        private CommandHandlerDriver $commandHandlerDriver,
        private Middleware $middlewares
    ) {
    }

    public function __invoke(Command $command): void
    {
        ($this->middlewares)($command, $this);
    }

    public function handle(Command $message): void
    {
        $handler = $this->commandHandlerDriver->getCommandHandlerFor(command: $message);
        ($handler)(command: $message);
    }
}
