<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use App\Application\Command;
use App\Domain\Event\DomainEvent;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\DomainEventBus;

use function is_null;

abstract class AbstractMiddleware implements Middleware
{
    public function __construct(
        private readonly ?Middleware $nextMiddleware = null
    ) {
    }

    abstract public function __invoke(Command|DomainEvent $command, CommandBus|DomainEventBus $commandBus): void;

    public function handle(Command|DomainEvent $command, CommandBus|DomainEventBus $commandBus): void
    {
        if (is_null($this->nextMiddleware)) {
            $commandBus->handle($command);
        } else {
            ($this->nextMiddleware)($command, $commandBus);
        }
    }
}
