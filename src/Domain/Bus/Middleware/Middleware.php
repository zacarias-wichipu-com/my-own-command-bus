<?php

declare(strict_types=1);

namespace App\Domain\Bus\Middleware;

use App\Domain\Bus\Command\Command;
use App\Domain\Event\DomainEvent;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\EventBus;

use function is_null;

abstract class Middleware
{
    public function __construct(
        private ?Middleware $nexMiddleware = null
    ) {
    }

    abstract public function __invoke(Command|DomainEvent $command, CommandBus|EventBus $commandBus): void;

    public function handle(Command|DomainEvent $command, CommandBus|EventBus $commandBus): void
    {
        if (is_null($this->nexMiddleware)) {
            $commandBus->handle($command);
        } else {
            ($this->nexMiddleware)($command, $commandBus);
        }
    }
}
