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

    public function registerEvent(string $eventFqn, DomainEventHandler $domainEventHandler): void
    {
        if (!array_key_exists($eventFqn, $this->handlers)) {
            $this->handlers[$eventFqn] = [];
        }
        $this->handlers[$eventFqn] = [
            ...$this->handlers[$eventFqn],
            ...[$domainEventHandler]
        ];
    }

    public function getDomainEventHandlersFor(DomainEvent $domainEvent): array
    {
        return $this->handlers[$domainEvent::class] ?? [];
    }
}
