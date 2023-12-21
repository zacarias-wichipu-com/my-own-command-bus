<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Application\DomainEventHandler;
use App\Domain\Event\DomainEvent;

final class DomainEventHandlerDriver
{
    /**
     * @var array<string, DomainEventHandler>
     */
    private array $listeners = [];

    public function registerEvents(string $eventFqn, DomainEventHandler $domainEventHandler): void
    {
        if (!array_key_exists($eventFqn, $this->listeners)) {
            $this->listeners[$eventFqn] = [];
        }
        $this->listeners[$eventFqn] = [
            ...$this->listeners[$eventFqn],
            ...[$domainEventHandler]
        ];
    }

    public function getDomainEventHandlersFor(DomainEvent $domainEvent): array
    {
        return $this->listeners[$domainEvent::class];
    }
}
