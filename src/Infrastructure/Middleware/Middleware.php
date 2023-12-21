<?php

declare(strict_types=1);

namespace App\Infrastructure\Middleware;

use App\Domain\Message\Command;
use App\Domain\Message\DomainEvent;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\DomainEventBus;

interface Middleware
{
    public function __invoke(Command|DomainEvent $message, CommandBus|DomainEventBus $bus): void;

    public function handle(Command|DomainEvent $message, CommandBus|DomainEventBus $bus): void;
}
