<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use App\Domain\Message\Command;
use App\Domain\Message\DomainEvent;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\DomainEventBus;

use function is_null;

abstract class AbstractMiddleware implements Middleware
{
    public function __construct(
        private readonly ?Middleware $nextMiddleware = null
    ) {
    }

    abstract public function __invoke(Command|DomainEvent $message, CommandBus|DomainEventBus $bus): void;

    public function handle(Command|DomainEvent $message, CommandBus|DomainEventBus $bus): void
    {
        if (is_null($this->nextMiddleware)) {
            $bus->handle($message);
        } else {
            ($this->nextMiddleware)($message, $bus);
        }
    }
}
