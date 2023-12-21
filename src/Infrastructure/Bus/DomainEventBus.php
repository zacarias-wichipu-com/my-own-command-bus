<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus;

use App\Domain\Message\Command;
use App\Domain\Message\DomainEvent;
use App\Domain\Message\PublisherBus;
use App\Infrastructure\Middleware\Middleware;


final readonly class DomainEventBus implements PublisherBus
{
    public function __construct(
        private DomainEventHandlerDriver $domainEventHandlerDriver,
        private Middleware $middlewares
    ) {
    }

    /**
     * @param array<string, DomainEvent> $domainEvents
     */
    public function __invoke(array $domainEvents): void
    {
        array_walk(
            array: $domainEvents,
            callback: fn(DomainEvent $domainEvent) => $this->publish($domainEvent)
        );
    }

    /**
     * @param array<string, DomainEvent> $domainEvents
     */
    public function publishEvents(array $domainEvents): void
    {
        array_walk(
            array: $domainEvents,
            callback: fn(DomainEvent $domainEvent) => $this->publish($domainEvent)
        );
    }

    private function publish(DomainEvent $domainEvent): void
    {
        ($this->middlewares)($domainEvent, $this);
    }

    public function handle(Command|DomainEvent $message): void
    {
        $handlers = $this->domainEventHandlerDriver->getDomainEventHandlersFor(domainEvent: $message);
        if (empty($handlers)) {
            return;
        }
        foreach ($handlers as $handler) {
            ($handler)(domainEvent: $message);
        }
    }
}
