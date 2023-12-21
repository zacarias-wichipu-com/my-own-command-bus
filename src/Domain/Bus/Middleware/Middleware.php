<?php

declare(strict_types=1);

namespace App\Domain\Bus\Middleware;

use App\Application\Command;
use App\Domain\Event\DomainEvent;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\DomainEventBus;

use function is_null;

abstract class Middleware
{
    public function __construct(
        private ?Middleware $nexMiddleware = null
    ) {
    }

    abstract public function __invoke(Command|DomainEvent $command, CommandBus|DomainEventBus $commandBus): void;

    public function handle(Command|DomainEvent $command, CommandBus|DomainEventBus $commandBus): void
    {
        if (is_null($this->nexMiddleware)) {
            $commandBus->handle($command);
        } else {
            ($this->nexMiddleware)($command, $commandBus);
        }
    }
}
