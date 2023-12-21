<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Message\DomainEvent;
use App\Domain\Message\DomainEventHandler;

final class DomainEventHandlerDriver
{
    /**
     * @var array<string, array<DomainEventHandler>>
     */
    private array $handlers = [];

    public function registerEvent(string $domainEventFqn, DomainEventHandler $domainEventHandler): void
    {
        if (!array_key_exists($domainEventFqn, $this->handlers)) {
            $this->handlers[$domainEventFqn] = [];
        }
        $this->handlers[$domainEventFqn] = [
            ...$this->handlers[$domainEventFqn],
            ...[$domainEventHandler]
        ];
    }

    public function getDomainEventHandlersFor(DomainEvent $domainEvent): array
    {
        return $this->handlers[$domainEvent::class] ?? [];
    }
}
